<?php

/**
 * the facade class
 */
class YoutubeDownloader
{
	private $youtube;
	private $ffmpeg;

	
	public function __construct(string $youtube_api_key)
	{
		$this->youtube = new Youtube($youtube_api_key);
		$this->ffmpeg = new FFMPEG();
	}

	public function downloadVideo(string $url, string $format)
	{
		$this->youtube->check($url);

		$this->youtube->getMeta($url);
		
		$video = $this->youtube->save($url);

		$this->ffmpeg->resize($video);

		$this->ffmpeg->format($video, $format);

		echo "DOOOOONE";
	}
}

/**
 * Youtube class that has all youtube operations
 */
class Youtube
{
	private $apiKey;

	public function __construct(string $apiKey)
	{
		$this->apiKey = $apiKey;
	}

	public function check(string $url)
	{
		echo "checking the url.... \n";
	}

	public function getMeta(string $url)
	{
		echo "get video meta data.... \n";
	}

	public function save(string $url)
	{
		echo "save the video.... \n";

		return "video";
	}
}

/**
 * FFMPEG class that has all ffmpeg operations
 */
class FFMPEG
{
	
	public function resize($video)
	{
		echo "resizing the video.... \n";
	}

	public function format($video, $format = 'mp4')
	{
		echo "format the video.... \n";
	}
}


$facade = new YoutubeDownloader("XXXX");
$facade->downloadVideo("https://www.youtube.com/watch?v=RpqqX6mkSNQ", "WMV");