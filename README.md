### Odpowiedzi na przesłane pytanie znajdują się w pliku `Odpowiedzi.pdf`
### Aby uruchomić zadania testowe należy wykonać poniższe kroki: 

##### 1. Sklonuj repo:
    git clone https://github.com/MarcelDrugi/RecruitmentTasks
##### 2. Przejdź do katalogu z zadaniami:
    cd RecruitmentTasks/RecruitmentTasks
##### 3. W w celu załadowania classloadera uruchom Composera:
    composer install
    composer dump-autoload
##### 4. W pliku `.env` ustaw połączenie ze swoją bazą danych uzupełniając 3 pola:
    DATABASE=
    USER=
    PASSWORD=
##### 5. Kolejne zadania można uruchamiać skryptami:
###### PHP zad. 1
    php run_php_task_1.php
###### PHP zad. 2
    php run_php_task_2.php
###### SQL zad. 1 i zad. 2
    php run_sql_tasks.php
###### Frontend zad. 1
    uruchomić w przeglądarce plik: front_task.html