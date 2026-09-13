<?php
require 'config.php';
$pdo=db();
$pdo->exec("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT NOT NULL,email TEXT UNIQUE NOT NULL,password TEXT NOT NULL,role TEXT NOT NULL DEFAULT 'patient',created_at TEXT DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS doctors (id INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT NOT NULL,specialty TEXT NOT NULL,experience INTEGER NOT NULL,fee INTEGER NOT NULL,availability TEXT NOT NULL);
CREATE TABLE IF NOT EXISTS appointments (id INTEGER PRIMARY KEY AUTOINCREMENT,user_id INTEGER NOT NULL,doctor_id INTEGER NOT NULL,appointment_date TEXT NOT NULL,appointment_time TEXT NOT NULL,mode TEXT NOT NULL,status TEXT NOT NULL DEFAULT 'Confirmed',notes TEXT,created_at TEXT DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id),FOREIGN KEY(doctor_id) REFERENCES doctors(id));
CREATE TABLE IF NOT EXISTS reports (id INTEGER PRIMARY KEY AUTOINCREMENT,user_id INTEGER NOT NULL,title TEXT NOT NULL,doctor_name TEXT NOT NULL,report_date TEXT NOT NULL,status TEXT NOT NULL DEFAULT 'Available',FOREIGN KEY(user_id) REFERENCES users(id));
CREATE TABLE IF NOT EXISTS support_tickets (id INTEGER PRIMARY KEY AUTOINCREMENT,user_id INTEGER,name TEXT NOT NULL,email TEXT NOT NULL,category TEXT NOT NULL,priority TEXT NOT NULL,subject TEXT NOT NULL,description TEXT NOT NULL,status TEXT NOT NULL DEFAULT 'Open',created_at TEXT DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS notifications (id INTEGER PRIMARY KEY AUTOINCREMENT,user_id INTEGER,message TEXT NOT NULL,channel TEXT NOT NULL,created_at TEXT DEFAULT CURRENT_TIMESTAMP);");
if((int)$pdo->query('SELECT COUNT(*) FROM doctors')->fetchColumn()===0){
 $s=$pdo->prepare('INSERT INTO doctors(name,specialty,experience,fee,availability) VALUES(?,?,?,?,?)');
 foreach([['Dr. Ananya Mehta','General Medicine',9,600,'Mon-Sat'],['Dr. Rahul Verma','Cardiology',14,1000,'Mon-Fri'],['Dr. Neha Iyer','Dermatology',8,750,'Tue-Sun'],['Dr. Arjun Rao','Pediatrics',11,800,'Mon-Sat'],['Dr. Priya Shah','Mental Wellness',10,900,'Mon-Fri'],['Dr. Kabir Singh','Orthopedics',13,950,'Wed-Sun']] as $d)$s->execute($d);
}
if((int)$pdo->query("SELECT COUNT(*) FROM users WHERE email='patient@medibook.demo'")->fetchColumn()===0){
 $s=$pdo->prepare('INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)');$s->execute(['Demo Patient','patient@medibook.demo',password_hash('Demo@123',PASSWORD_DEFAULT),'patient']);
 $uid=(int)$pdo->lastInsertId();
 $r=$pdo->prepare('INSERT INTO reports(user_id,title,doctor_name,report_date,status) VALUES(?,?,?,?,?)');
 $r->execute([$uid,'General Health Consultation Summary','Dr. Ananya Mehta',date('Y-m-d',strtotime('-12 days')),'Available']);
 $r->execute([$uid,'Blood Test Overview','Dr. Rahul Verma',date('Y-m-d',strtotime('-30 days')),'Available']);
}
flash('success','MediBook database is ready. Sign in with patient@medibook.demo / Demo@123');
header('Location: login.php');
?>