<?php
class UserModel extends CI_Model
{
    public function profil($by){
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row();
        if($by == 'nama'){
            $result = $user->nama_user;
        }else if($by == 'email'){
            $result = $user->email;
        }else if($by == 'foto'){
            $result = $user->foto_user ? $user->foto_user : 'user_1.png';
        }else if($by == 'jk'){
            $result = $user->jenis_kelamin;
        }else if($by == 'tgl_lahir'){
            $result = $this->format_tanggal($user->tanggal_lahir);
        }else if($by == 'id'){
            $result = $user->id_user;
        }
        return $result;
    }

    public function format_tanggal($Tgal,$jam="yes",$idBahasa = 'id'){
		if($Tgal == ""){
			return;
		}
		$tanggal = explode(' ',$Tgal);
		$mdy=explode('-',$tanggal[0]);
		$mBul=$mdy[1];
		
		if($idBahasa == "id"){
	
		    if($mBul=='01'){$isBulan='Jan';}elseif($mBul=='02'){$isBulan='Feb';}
		    elseif($mBul=='03'){$isBulan='Mar';}elseif($mBul=='04'){$isBulan='Apr';}
		    elseif($mBul=='05'){$isBulan='Mei';}elseif($mBul=='06'){$isBulan='Jun';}
		    elseif($mBul=='07'){$isBulan='Jul';}elseif($mBul=='08'){$isBulan='Ags';}
		    elseif($mBul=='09'){$isBulan='Sep';}elseif($mBul=='10'){$isBulan='Okt';}
		    elseif($mBul=='11'){$isBulan='Nop';}elseif($mBul=='12'){$isBulan='Des';}
		    elseif($mBul=='00'){$isBulan='00';}
		    
		    $hasil = $mdy[2].' '.$isBulan.' '.$mdy[0];
		    if(count($tanggal) == 2) {
			if($jam == "yes"){
			    $hasil = $mdy[2].' '.$isBulan.' '.$mdy[0]. ' '. substr($tanggal[1],0,5);
			}else{
			    $hasil = $mdy[2].' '.$isBulan.' '.$mdy[0];
			}
		    }
		    
		}
		return $hasil;
	}

}