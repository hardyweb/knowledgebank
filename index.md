# knowledgebank

<https://github.com/hardyweb/knowledgebank/blob/main/knowledgebank.md>


## Menggunakan youtube-dl
Check video/audio'
youtube-dl.exe -F <utube url>
Download video/audio tukar ke ogg file
youtube-dl.exe -x -f 18 --audio-format vorbis  <utube url>

## Download audio dari youtube guna MPV
pastikan anda mempunyai player mpv, guna fungsi --record-file
mpv --record-file=namalagu.ogg <url utube> --no-video

## Membuat playlist
DIR *.* /A-D/B/S/ON > playlist.m3u

## Menggunakan Rsync
tukar dari drive C, D, E, F , G mengikut keadaan.
rsync.exe -azv /cygdrive/c/folder/yang/ingin/dibackup/ /cygdrive/g/distinasi/


