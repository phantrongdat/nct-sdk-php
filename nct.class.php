<?php

/* Begin With Some Note 
	
	* This SDK is not by NCT Crop
	* This SDK is not for COMMERCIAL
	* The SDK by Phuc Phoenix (github@phuchptty)
	* You Can Find Me At
		+ Facebook: https://facebook.com/hoangphuchotboy
		+ Twitter : @phoenix371
		+ GitHub  : phuchptty
	* The URL API is Open by anbinh (https://github.com/anbinh)

This is END */

class NCT {

	// NCT Private Key
	private $nct_token_key = "nct@asdgvhfhyth1391515932000";

	private $index = 1;

	private $size = 30;

	private function getCurl($url){
		$ch = @curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		$head[] = "Connection: keep-alive";
		$head[] = "Keep-Alive: 300";
		$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$head[] = "Accept-Language: en-us,en;q=0.5";
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
		$page = curl_exec($ch);
		curl_close($ch);
		return $page;
	}

	private function createToken($type,$id){
		return md5($type.$id.$this ->nct_token_key);
	}

	private function createSearchToken($type,$keyword){
		return md5($type.$keyword.$this -> index.$this -> size.$this ->nct_token_key);
	}

	private function buildURL($action,$token,$option){

		$api = 'http://api.m.nhaccuatui.com/mobile/v5.0/api?secretkey=nct@mobile_service&deviceinfo={"DeviceID":"90c18c4cb3c37d442e8386631d46b46f","OsName":"ANDROID","OsVersion":"10","AppName":"NhacCuaTui","AppVersion":"5.0.1","UserInfo":"","LocationInfo":""}&pageindex='.$this -> index.'&pagesize='.$this -> size.'&time=1391515932000&token='.$token.'&action='.$action.'&'.$option;
		return $api;
	}

	
	public function getSongID($key){
		if ($key == NULL){
			return false;
		}

		$url = "http://www.nhaccuatui.com/bai-hat/fdjhdffd-dgad.".$key.".html";
		$get = $this -> getCurl($url);
		preg_match_all('/itemid:(.*),/U', $get, $itemid);

		return $itemid[1][1];
	}

	public function getVideoID($key){
		if ($key == NULL){
			return false;
		}

		$url = "http://www.nhaccuatui.com/video/fdjhdffd-dgad.".$key.".html";
		$get = $this -> getCurl($url);
		preg_match_all('/itemid:(.*),/U', $get, $itemid);

		return $itemid[1][1];
	}

	public function getPlaylistID($key){
		if ($key == NULL){
			return false;
		}

		$url = "http://www.nhaccuatui.com/playlist/fdjhdffd-dgad.".$key.".html";
		$get = $this -> getCurl($url);
		preg_match_all('/itemid:(.*),/U', $get, $itemid);

		return $itemid[1][1];
	}
	

	/* API about Song */

	public function getSongInfo($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createToken("get-song-info",$id);
		$url = $this -> buildURL("get-song-info",$token,"songid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);

		if ($b['Result'] == false){
			return false;
		}

		return $a;
	}

	public function getLyric($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createToken("get-lyric",$id);
		$url = $this -> buildURL("get-lyric",$token,"songid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);

		if ($b['Result'] == false){
			return false;
		}

		return $a;
	}

	public function getSongSearch($keyword){

		$token = $this -> createSearchToken("search-song",$keyword);
		$url = $this -> buildURL("search-song",$token,"keyword=".$keyword);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);

		
		if ($b['Result'] == false){
			return false;
		}
		

		return $a;
	}

	public function getSongOfPlaylist($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createToken("get-song-by-playlistid",$id);
		$url = $this -> buildURL("get-song-by-playlistid",$token,"playlistid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);

		if ($b['Result'] == false){
			return false;
		}

		return $a;
	}

	public function getSongByArtist($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createSearchToken("get-song-by-artist",$id);
		$url = $this -> buildURL("get-song-by-artist",$token,"artistid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);
		
		if ($b['Result'] == false){
			return false;
		}
		
		return $a;
	}

	public function getSongByGene($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createSearchToken("get-song-by-genre",$id);
		$url = $this -> buildURL("get-song-by-genre",$token,"genreid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);
		
		if ($b['Result'] == false){
			return false;
		}
		
		return $a;
	}

	/* API About Playlist */

	public function getPlaylistInfo($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createToken("get-playlist-info",$id);
		$url = $this -> buildURL("get-playlist-info",$token,"playlistid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);

		if ($b['Result'] == false){
			return false;
		}

		return $a;
	}

	public function getPlaylistByArtist($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createSearchToken("get-playlist-by-artist",$id);
		$url = $this -> buildURL("get-playlist-by-artist",$token,"artistid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);
		
		if ($b['Result'] == false){
			return false;
		}
		
		return $a;
	}

	public function getPlaylistByGene($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createSearchToken("get-playlist-by-genre",$id);
		$url = $this -> buildURL("get-playlist-by-genre",$token,"genreid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);
		
		if ($b['Result'] == false){
			return false;
		}
		
		return $a;
	}

	public function getPlaylistSearch($id){

		$token = $this -> createSearchToken("search-playlist",$id);
		$url = $this -> buildURL("search-playlist",$token,"keyword=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);
		
		if ($b['Result'] == false){
			return false;
		}
		
		return $a;
	}

	public function getPlaylistByTopic($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createToken("get-playlist-by-topic",$id);
		$url = $this -> buildURL("get-playlist-by-topic",$token,"topicid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);
		
		if ($b['Result'] == false){
			return false;
		}
		
		return $a;
	}

	public function getPlaylistRelated($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createToken("get-playlist-related",$id);
		$url = $this -> buildURL("get-playlist-related",$token,"playlistid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);
		
		if ($b['Result'] == false){
			return false;
		}
		
		return $a;
	}

	/* API VIDEO */

	public function getVideoInfo($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createToken("get-video-detail",$id);
		$url = $this -> buildURL("get-video-detail",$token,"videoid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);

		if ($b['Result'] == false){
			return false;
		}

		return $a;
	}

	public function getVideoByArtist($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createSearchToken("get-video-by-artist",$id);
		$url = $this -> buildURL("get-video-by-artist",$token,"artistid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);
		
		if ($b['Result'] == false){
			return false;
		}
		
		return $a;
	}

	public function getVideoByGene($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createSearchToken("get-video-by-genre",$id);
		$url = $this -> buildURL("get-video-by-genre",$token,"genreid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);
		
		if ($b['Result'] == false){
			return false;
		}
		
		return $a;
	}

	public function getVideoSearch($id){

		$token = $this -> createSearchToken("search-video",$id);
		$url = $this -> buildURL("search-video",$token,"keyword=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);
		
		if ($b['Result'] == false){
			return false;
		}
		
		return $a;
	}

	public function getVideoRelated($id){
		if (!isset($id) || $id == NULL){
			return false;
		}

		$token = $this -> createToken("get-video-related",$id);
		$url = $this -> buildURL("get-video-related",$token,"videoid=".$id);

		$a = $this -> getCurl($url);

		$b = json_decode($a,true);
		
		if ($b['Result'] == false){
			return false;
		}
		
		return $a;
	}
}

/* End SDK */
?>
