<?php
    class Register_model extends CI_Model{
        public function __construct() {
            parent::__construct();
            session_start();
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
                                    "mobileNumber" => trim($tpnumbers[$i][0]),
                                    "contactName" => $tpnumbers[$i][1]
                                );
                                $this->db->insert('shopmobilenumber',$tp);
                        
                        }
                        $alert["bool"]=TRUE;
                        $alert["msg"]=$data["email"]." registered successfully";
                        
                }
                else{
                        $alert["bool"]=FALSE;
                        $alert["msg"]=$data["email"]." is already registered in the system";
                }
                return $alert;
        }
        public function shop_edit($data){
            $id = $data["shopid"];
                
            $shop = array(
                "shopName" => $data["shopname"],
                "ownerName" => $data["ownername"],
                "address" => $data["address"],
                "fax" => $data["fax"],
                "about" => $data["about"],
                "email" => $data["email"]
            );
            $this->db->where('id',$id);
            $this->db->update('provider',$shop);
            $tpnumbers = $data["tpnumbers"];
                       
            $this->db->where('shopID',$id);
            $this->db->delete('shopmobilenumber');
            
            for($i=0;$i<count($tpnumbers);$i++){
                    $tp = array(
                        "shopID" => $data["shopid"],
                        "mobileNumber" => trim($tpnumbers[$i][0]),
                        "contactName" => $tpnumbers[$i][1]
                    );
                    $this->db->insert('shopmobilenumber',$tp);

            }
            $alert["bool"]=TRUE;
            $alert["msg"]=$data["email"]." edited successfully";
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
        public function getCustomerID($email){
            $query=$this->db->query("SELECT id FROM customer WHERE email = '$email';");
            $shopID="";
            if($query->num_rows()>0){
                $obj = $query->result();
                return $obj[0]->id;
            }
        }
        
        public function insert_picture($table,$id,$path){
            $this->db->where('id', $id);
            $this->db->update($table, array("picture" => $path));
            //$this->db->query("UPDATE $table SET picture = '$path' WHERE id = '$id';");
            $alert="Picture is uploaded successfully";
            return $alert;
            
        }
        public function registerCustomer($data){
                
                $query=$this->db->query("SELECT password FROM user WHERE email = '".$this->db->escape_str($data["custemail"])."';");
                $alert="";
                if($query->num_rows()==0){
                        $customer = array(
                            "id" => $data["custid"],
                            "name" => $data["custname"],
//                            "userName" => $data["custusername"],
                            "address" => $data["custaddress"],
                            "email" => $data["custemail"],
                            "picture" => $data["cuspic"]
                            
                        );
                        $this->db->insert('customer',$customer);
                        if($data["custtp"]!=""){
                            $mobile = array(
                                "customerID" => $data["custid"],
                                "mobileNumber" => $data["custtp"]
                            );
                            $this->db->insert('customermobilenumber',$mobile);
                        }
                        
                        $user = array(
                            "email" => $data["custemail"],
                            "password" => $data["custpass"],
                            "userType" => "customer"
                        );
                        $this->db->insert('user',$user);
                        
                        $alert["bool"]=TRUE;
                        $alert["msg"]=$data["custemail"]." registered successfully";
                        
                }
                else{
                        $alert["bool"]=FALSE;
                        $alert["msg"]=$data["custemail"]." is already registered in the system";
                }
                return $alert;
        }
        
         public function editCustomerModel($data){
                $id = $_SESSION['id'];
                
                $alert="";
                if ($data){
                        $details = array(
                            "name" => $data["custresetname"],
                            "address" => $data["custresetaddress"],
                            "telephone" => $data["custresettp"]
                        );
                        $this->db->where('id',$id);
                        $this->db->update('customer', $details);
                        $alert["bool"]=TRUE;
                        $alert["msg"]="changes updated successfully";
                        
                }
                else{
                        $alert["bool"]=FALSE;
                        $alert["msg"]=$data["custreetname"]." has provided wrong details";
                }
                return $alert;
        }
        
        public function changeCustomerPasswordModel($data){
            session_start();
            $email = $_SESSION['email'];
            
            $query = $this->db->query("SELECT password FROM user WHERE email = '$email';");
            $obj = $query->result();
            $alert="";
            $details = array("password" => $data['resetnewpass']);
            if ($obj[0]->password === $data['resetoldpass']){ // if they can be compared
                $this->db->where('email',$email);
                $this->db->update('user', $details);
                $alert["bool"] = TRUE;
                $alert["msg"] = "password succesfully updated!";
            }
            else{
               
                $alert["bool"] = FALSE;
                $alert["msg"] = "invalid old password!";
            }
                
            return alert;
        }
        
//        public function deleteCustomerAccount($id, $email){
//            if ($person == 'customer'){
//                $query1 = $this->db->delete('user', array('email'=> ermail));
//                $query2 = $this->db->delete('customer', array('email'=> ermail));
//               
//            }
//           
            
        //}
    }
?>
