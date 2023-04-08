# Knowladge Bank 

## Compile Neovim 

-- baru download dari repo

`$git clone https://github.com/neovim/neovim.git`

`$cd neovim`

`$make`

`$sudo make install`

-- folder neovim sedia ada dalam pc
 
`$cd Neovim`	

`$git pull`

`$rm -rf .deps/`

`$rm -rf builds/`

`$make`

`$sudo make install`



## Neovim motion 

1. yi( = copy dalam parentheses

2. yi{ = copy dalam curly bracket 

3. yiw = copy word sahaja

4. vi( = select block dalam parentheses

5. vi{ = select block dalam urly bracket 

6. vat = select antara tag html

8. set relativenumber as true in init.lua  
 

## Neovim indent 

1. gg=G 

## Neovim remote edit 

1. :e scp://user@ipadress.port//home/blabla/file.txt

## zsh Shell

spaceship-zsh
https://github.com/spaceship-prompt/spaceship-prompt

## Neovim Motion 

Untuk bergerak secara ventrikal, boleh tekan nombor dan j, dan 
untuk ke tiap-tiap perkataan tekan F, sama dengan tekan ctrl+w

## git amend 

`git commit --amend --no-edit`

## git squash 

guna squash untuk combine beberapa buah commit menjadi sebuah commit 
baharu.
          ┌───┐      ┌───┐     ┌───┐      ┌───┐
    ...   │ A │◄─────┤ B │◄────┤ C │◄─────┤ D │
          └───┘      └───┘     └───┘      └───┘
 After Squashing commits B, C, and D:
          ┌───┐      ┌───┐
    ...   │ A │◄─────┤ E │
          └───┘      └───┘

          ( The commit E includes the changes in B, C, and D.)

`git rebase -i HEAD~berapacommit`

tulis s untuk squash dalam nota commit dan simpan, 
git akan rebase mengikut jumlah commit yang ditanda. 

kemudian pastikan dalam gitlab, repo tersebut menerima force push. 

`git push origin +master` atau `git push origin +branch`

## Cipta Terminal dalam Neovim 

:bo 15sp +te

## OBS mkv x264 output video to ffmpeg mkv av1 (svt-av1) video

ffmpg -i video.mkv -c:v libsvtav1 -crf 17 videooutput.mkv

## Vagrant ssh alternative

ssh -o StrictHostKeyChecking=no -o UserKnowHostsFile=/dev/null -i
.vagrant/machines/default/virtualbox/private_key -p 2222 vagrant@127.0.0.1

## laravel build in php artisan serve 

also can run php artisan ser ( --host 0.0.0.0 )

##


