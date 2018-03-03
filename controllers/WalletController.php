<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use GatewayClient\Gateway;


class WalletController extends Controller
{
    /*
    public function __construct($id, $module, $config = []){
        parent::__construct($id, $module, $config = []);
        $this->layout = "wallet";
    }
    */
    private static $use_uid = "rat16";
    private static $db_idx = 1;
    
   function actionIndex()
   {
       $username = "btc_wallet";
       return $this->render("index", ['username' => $username]);
   }
   
   function actionGetnewaddress()
   {
       $redis = Yii::$app->redis;
       $redis->select(self::$db_idx);
       
       $btc_type = Yii::$app->request->post('btc_type', 'btc');
       $btc_id = uniqid();
       
       $redis->set($btc_id, "");
       
       require_once 'GatewayClient-3.0.0/Gateway.php';
       Gateway::$registerAddress = "127.0.0.1:5100";
       
       $data = [
           "btc_id"     => $btc_id,
           "btc_type"   => $btc_type,
           "cmd"        => 10000,
       ];
       
       Gateway::sendToUid(self::$use_uid, json_encode($data));
       
       
       $rsp_data = [
           'code' => 0,
           'btc_id' => $btc_id,
       ];
       
       echo json_encode($rsp_data);
       exit;
   }
   
   function actionGetaddrstatus()
   {
       $redis = Yii::$app->redis;
       $redis->select(1);
       
       $btc_id= Yii::$app->request->post('btc_id', 0);
       $btc_data_json = $redis->get($btc_id);
       if(!empty($btc_data_json))
       {
           $btc_data = json_decode($btc_data_json, true);
           $data = [
               "code"           => 0,
               "btc_addr"       => $btc_data['btc_addr'],
               "btc_priv_key"   => $btc_data['btc_priv_key'],
               "btc_type"       => strtoupper($btc_data['btc_type']),
           ];
           
           $redis->del($btc_id);
       }
       else
      {
           $data = [
               "code"           => 1,
               "btc_addr"       => "",
               "btc_priv_key"   => "",
           ];
       }
       
       echo json_encode($data);
       exit;
       
   }
   
   function actionGetkey()
   {
       
       $redis = Yii::$app->redis;
       $redis->select(1);
       $redis->set("k1", "v1");
       $ret = $redis->get("k1");
       $redis->del("k1");
       var_dump($ret);
       exit;
   }
}
