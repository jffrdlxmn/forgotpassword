<?php
	date_default_timezone_set('Asia/Manila');	
	require_once ('config.php');
	class employeePortal extends Connect
	{
		
        
		function checkExist($email)
		{
			$usernameData = array();
			$studNumData=array();
			$sql = "SELECT * FROM enrollusertbl WHERE `email`=?";
			$stmt = $this->db->prepare($sql);
			$stmt->execute(array($email));
            $studNumData = $stmt->fetch(PDO::FETCH_ASSOC);
			if($studNumData>0){
				return "1";
			}
            else return "0"; 

		}
		
		function getEmployeeData($email)
		{
			$studNumData=array();
			$sql = "SELECT * FROM enrollusertbl WHERE `email`=?";
			$stmt = $this->db->prepare($sql);
			$stmt->execute(array($email));
            $studNumData = $stmt->fetch(PDO::FETCH_ASSOC);
			if($studNumData>0){
				return $studNumData;
			}
            else return "0"; 
		}


		function resetPassword($email,$token,$newPassword){
			$newPassword= md5($newPassword);
            $updateData=[];
			$updateData=[
				'email'=>$email,
				'newPassword'=>$newPassword
			];
			$sql = "UPDATE enrollusertbl SET `userpasswd`=:newPassword
			WHERE `email`=:email";
			$stmt = $this->db->prepare($sql);
			$stmt->execute($updateData);
			if($stmt) {
				$sqlToken = "DELETE FROM forgatpassword_code WHERE `token`=?";
				$stmtToken = $this->db->prepare($sqlToken);
				$stmtToken->execute([$token]);
				if($stmtToken) return 1;
				
			}
			else return 0;
		}

		
		function checkToken($token,$email)
		{
			$dateNOW = date("Y-m-d H:i:s");	
			$tokenData = array();
			$sql = "SELECT * FROM forgatpassword_code WHERE `token`=? AND `email`=?";
			$stmt = $this->db->prepare($sql);
			$stmt->execute(array($token,$email));
            $tokenData = $stmt->fetch(PDO::FETCH_ASSOC);
			if($tokenData>0){
				$dateToken = $tokenData['create_n'];

				if($dateNOW > $dateToken) return "2";
				else return "1";
			}
            else return "0"; 
		}

		

		function saveToken($email,$token)
		{


			$date =  date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +15 minutes"));

			$empData=array();
			$sqlEmp = "SELECT * FROM forgatpassword_code WHERE `email`=?";
			$stmtEmp = $this->db->prepare($sqlEmp);
			$stmtEmp->execute(array($email));
            $dataEmp = $stmtEmp->fetch(PDO::FETCH_ASSOC);
			if($dataEmp>0){
			
				$updateData=[];
				$updateData=[
					'email'=>$email,
					'token'=>$token,
					'date'=>$date,
				];
				$sqlToken = "UPDATE forgatpassword_code SET `token`=:token, `create_n`=:date
				WHERE `email`=:email";
				$stmtToken = $this->db->prepare($sqlToken);
				$stmtToken->execute($updateData);
				if($stmtToken)return 1;
				else return 0;
			}
            else{
				$addData=[];
				$addData=[
					'email'=>$email,
					'token'=>$token,
					'date'=>$date,
				];
				$sqlToken = "INSERT INTO forgatpassword_code(`email`,`token`,`create_n`)
				VALUES (:email,:token,:date)";
				$stmtToken = $this->db->prepare($sqlToken);
				$stmtToken->execute($addData);
				if($stmtToken) return 1;
			}
		

		}
        
	}	
?>