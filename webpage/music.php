<?php 

$playlist = (isset($_REQUEST["playlist"]))?$_REQUEST["playlist"]:NULL;

$shuffle = (isset($_REQUEST["shuffle"]))?$_REQUEST["shuffle"]:NULL;

function songSize($fileSize) 
{
	    if($fileSize > 0 && $fileSize <= 1023)
	    {
	        return $fileSize . " b";
	    }
	    elseif ($fileSize >= 1024 && $fileSize <= 1048575)
	    {
	        return round($fileSize/1024, 2) . " kb";
	    }
	    elseif ($fileSize >= 1048576) 
	    {
	        return round($fileSize/1048576, 2) . " mb";
	    }
    
}
?>
<DOCTYPE>
	<head>
		<title>Music Viewer</title>
		<link rel="stylesheet" type="text/css" href="viewer.css">
		</head>
	<body>
		<div id="header">

			<h1><?php echo '190M Music Playlist Viewer' ?></h1>
			<h2><?php echo 'Search Through Your Playlists and Music' ?></h2>
		</div>


		<div id="listarea">
			<ul id="musiclist">
				<?php
                if($playlist)
                {
                    $songs = file("songs/$playlist", FILE_IGNORE_NEW_LINES);
                }
                elseif($shuffle)
                {
                    $songs = glob("songs/*.mp3");
                    shuffle($songs);
                }
                else
                {
                    $songs = glob("songs/*.mp3");
                }

                foreach ( $songs as $song) 
                {
                    if(strstr($song, ".mp3"))
                    {
                    ?>
                    <li class="mp3item" ><a href="<?= $item?> "> <?= basename($song) ?></a> (<?= songSize(filesize("songs/". basename($song))) ?>)</li>
                <?php } 
            	}

                $set = glob("songs/*.m3u");
                if(!($playlist))
                {
                    foreach ( $set as $song) 
                    {
                    ?>
                    <li class="playlistitem" ><a href="music.php?playlist=<?= basename($song)?>"> <?= basename($song) ?>   </a> </li>

                <?php } 
            	} 
            	?>
			</ul>
		</div>
	</body>
</html>
