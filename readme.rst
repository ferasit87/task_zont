###################
Task for work based on CodeIgniter
###################

data base structuer in the file db.sql

if site doesnot with urls then you have to see your host setting and file /application/config/config.php
or work you can use phpstorm buitl in server for running site

all the taks work with speed < 100 ms

for the task of

create temp table users(id bigserial, group_id bigint);
insert into users(group_id) values (1), (1), (1), (2), (1), (3);
В этой таблице, упорядоченой по ID необходимо:
    1    выделить непрерывные группы по group_id с учетом указанного порядка записей (их 4)
         answer  = select * from users order by group_id , id
    2    подсчитать количество записей в каждой группе
         answer  = select count(group_id), group_id from users GROUP BY group_id
    3    вычислить минимальный ID записи в группе
         answer  = select min(id) , group_id from users GROUP BY group_id

