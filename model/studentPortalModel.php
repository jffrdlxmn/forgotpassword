<?php
	require_once ('config.php');
	class studentPortal extends Connect
	{
		
        
		function checkExist($studentNumber,$username)
		{
			$usernameData = array();
			$studNumData=array();
			$sql = "SELECT * FROM enrolltblportal WHERE `studnum`=?";
			$stmt = $this->db->prepare($sql);
			$stmt->execute(array($studentNumber));
            $studNumData = $stmt->fetch(PDO::FETCH_ASSOC);
			if($studNumData>0){
				$usernameSql = "SELECT * FROM enrolltblportal WHERE `username`=? AND  `studnum`=?";
				$usernameStmt = $this->db->prepare($usernameSql);
				$usernameStmt->execute(array($username,$studentNumber));
				$usernameData = $usernameStmt->fetch(PDO::FETCH_ASSOC);
				if($usernameData>0){
					return "1";
				}
				else return "2";
			}
            else return "0"; 

		}
		
       


		function resetPassword($studentNumber,$newPassword){
            $updateData=[];
			$updateData=[
				'studentNumber'=>$studentNumber,
				'newPassword'=>$newPassword
			];
			$sql = "UPDATE enrolltblportal SET `password`=:newPassword
			WHERE `studnum`=:studentNumber";
			$stmt = $this->db->prepare($sql);
			$stmt->execute($updateData);
			if($stmt) return 1;
			else return 0;
		}



		
        
	}	
?>