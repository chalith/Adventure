<?php
    class Register_model extends CI_Model{
        public function __construct() {
            parent::__construct();
        }
        
        public function shop_register($data){
                $query=$this->db->query("SELECT password FROM user WHERE email = '".$this->db->escape_str($data["email"])."';");
                $alert="";
                if($query->num_rows()==0){
                        $shop = array(
                            "id" => $data["shopid"],
                            "shopName" => $data["shopname"],
                            "ownerName" => $data["ownername"],
                            "address" => $data["address"],
                            "fax" => $data["fax"],
                            "about" => $data["about"],
                            "email" => $data["email"],
                            "picture" => $data["picture"],
                        );
                        $this->db->insert('provider',$shop);

                        $user = array(
                            "email" => $data["email"],
                            "password" => $data["password"],
                            "userType" => "provider"
                        );
                        $this->db->insert('user',$user);
                        $tpnumbers = $data["tpnumbers"];
                        
                        for($i=0;$i<count($tpnumbers);$i++){
                                $tp = array(
                                    "shopID" => $data["shopid"],
                                    "mobileNumber" => $tpnumbers[$i][0],
                                    "contactName" => $tpnumbers[$i][1]
                                );
                                $this->db->insert('shopmobilenumber',$tp);
                        
                        }
                        $alert["bool"]=TRUE;
                        $alert["msg"]=$data["shopname"]." registered successfully";
                        
                }
                else{
                        $alert["bool"]=FALSE;
                        $alert["msg"]=$data["email"]." is already registered in the system";
                }
                return $alert;
        }
        public function getShopID($email){
            $query=$this->db->query("SELECT id FROM provider WHERE email = '$email';");
            $shopID="";
            if($query->num_rows()>0){
                $obj = $query->result();
                return $obj[0]->id;
            }
        }
        public function insert_picture($shopID,$path){
            $this->db->where('id', $shopID);
            $this->db->update('provider', $path);
            $alert="Picture is uploaded successfully";
            return $alert;
            
        }
        public function registerCustomer($data){
                
                $query=$this->db->query("SELECT password FROM user WHERE email = '".$this->db->escape_str($data["custemail"])."';");
                $alert="";
                if($query->num_rows()==0){
                        $customer = array(
                            "customerId" => $data["custid"],
                            "name" => $data["custname"],
//                            "userName" => $data["custusername"],
                            "address" => $data["custaddress"],
                            "email" => $data["custemail"],
                            "telephone" => $data["custtp"]
                           
                        );
                        $this->db->insert('customer',$customer);

                        $user = array(
                            "email" => $data["custemail"],
                            "password" => $data["custpass"],
                            "userType" => "customer"
                        );
                        $this->db->insert('user',$user);
                        
                        $alert["bool"]=TRUE;
                        $alert["msg"]=$data["custname"]." registered successfully";
                        
                }
                else{
                        $alert["bool"]=FALSE;
                        $alert["msg"]=$data["custemail"]." is already registered in the system";
                }
                return $alert;
        }
    }
?>
