
How i create the Tables via raw SQL Code:

CREATE TABLE machines (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
max_capacity INT NOT NULL,
weight_increment INT NOT NULL
);

CREATE TABLE person (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
height INT NOT NULL
);

CREATE TABLE trainingPlan (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
person_id INT NOT NULL,
FOREIGN KEY (person_id) REFERENCES person(id) muss noch
);

CREATE TABLE trainingPlanXMachines (
id INT AUTO_INCREMENT PRIMARY KEY,
weight INT NOT NULL,
interval INT NOT NULL,
repetitions INT NOT NULL,
training_plan_id INT NOT NULL,
machine_id INT NOT NULL,
FOREIGN KEY (training_plan_id) REFERENCES trainingPlan(id),
FOREIGN KEY (machines_id) REFERENCES machines(id) muss noch
);

CREATE TABLE trainingExecution (
id INT AUTO_INCREMENT PRIMARY KEY,
date DATE NOT NULL,
training_plan_x_machine_id INT NOT NULL,
completed BOOLEAN NOT NULL,
FOREIGN KEY (training_plan_x_machine_id) REFERENCES trainingPlanXMachines(id)
);

CREATE TABLE weightHistory (
id INT AUTO_INCREMENT PRIMARY KEY,
date DATE NOT NULL,
weight INT NOT NULL,
person_id INT NOT NULL,
FOREIGN KEY (person_id) REFERENCES person(id)
);


My Steps:
1. Install Symfony
2. Create Symfony Project [composer create-project symfony/skeleton <project name>]
3. navigate to project
4. install all required packages:
   composer require symfony/orm-pack
   composer require --dev symfony/maker-bundle
   composer require symfony/twig-pack
   composer require symfony/twig-bundle
   composer require symfony/asset
   npm install tailwindcss
   npm install bulma 

5. create all Entities and their fields using the maker bundle (Person, Machines, TrainingPlan, TrainingPlanXMachine, TrainingExecution, WeightHistory)
   symfony console make:entity Person
   symfony console make:entity Machines
   symfony console make:entity TrainingPlan
   symfony console make:entity TrainingPlanXMachine
   symfony console make:entity TrainingExecution
   symfony console make:entity WeightHistory
5.1 After that make the migration:
   symfony console make:migrations:migrate
   symfony console doctrine:migrations:migrate
5.2 Then create Data via Fictures:
   composer require --dev doctrine/doctrine-fixtures-bundle
After that use Fixtures to give your database data
   symfony console make:fixtures PersonFixtures
   symfony console make:fixtures MachinesFixtures
   symfony console make:fixtures TrainingPlanFixtures
   symfony console make:fixtures TrainingPlanXMachineFixtures
   symfony console make:fixtures TrainingExecutionFixtures
   symfony console make:fixtures WeightHistoryFixtures



6. create the CRUD Controller(Person, Machines, TrainingPlan):
Run - composer require form validator security-csrf
   php bin/console make:crud Person
   php bin/console make:crud Machines
   php bin/console make:crud TrainingPlan

7. configure the database connection in the .env file and create Database:
   symfony console doctrine:database:create

8. run the migration to create the tables in the database:
   symfony console make:migration
   symfony console doctrine:migrations:migrate

9. start the Symfony server:
   symfony server:start -d



