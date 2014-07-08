CREATE DATABASE IF NOT EXISTS answerme;

USE answerme;

DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `user_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usertype` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO users VALUES("U001","pass1","John","john@taylors.edu.my","1");
INSERT INTO users VALUES("U002","pass2","Ali","ali@taylors.edu.my","2");
INSERT INTO users VALUES("U003","pass3","Sina","sina@taylors.my","3");
INSERT INTO users VALUES("U004","pass4","Sree","sree@taylors.my","1");
INSERT INTO users VALUES("U005","pass5","Melissa","melissa@taylors.my","2");
INSERT INTO users VALUES("U006","pass6","Allan","allan@taylors.my","3");
INSERT INTO users VALUES("U007","welcome","George","george@taylors.my","2");
INSERT INTO users VALUES("U008","test","TestUser","test@my.com","1");
INSERT INTO users VALUES("U009","test","TestUser2","test@my.com","2");
INSERT INTO users VALUES("U010","test","TestUser3","test@my.com","3");



DROP TABLE IF EXISTS modules;

CREATE TABLE `modules` (
  `mod_id` varchar(50) NOT NULL,
  `mod_name` varchar(50) NOT NULL,
  PRIMARY KEY (`mod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO modules VALUES("S001","Biology");
INSERT INTO modules VALUES("S002","Geography");
INSERT INTO modules VALUES("S003","IT");
INSERT INTO modules VALUES("S004","Design");



DROP TABLE IF EXISTS obj_questions;

CREATE TABLE `obj_questions` (
  `question_id` varchar(50) NOT NULL,
  `question_text` text,
  `ans_a` text,
  `ans_b` text,
  `ans_c` text,
  `ans_d` text,
  `topic` varchar(50) NOT NULL,
  `mod_id` varchar(50) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO obj_questions VALUES("Q001","Ordinary table salt is sodium chloride. What is baking soda?\n","Potassium chloride\n","Potassium carbonate\n","Potassium hydroxide\n","Sodium bicarbonate\n","Biology1","S001");
INSERT INTO obj_questions VALUES("Q002","The most abundant bio molecule on the earth \n","Nucleic acids\n","proteins\n","lipids\n","carbohydrates\n","Biology1","S001");
INSERT INTO obj_questions VALUES("Q003","The major functions of carbohydrates include\n","structural framework\n","storage\n","both a and b\n","none of these\n","Biology1","S001");
INSERT INTO obj_questions VALUES("Q004","The general formula of carbohydrate is\n","(CH2O)n\n","(C4H2O)n\n","(C6H2O)n\n","(C2H2O)n COOH\n","Biology1","S001");
INSERT INTO obj_questions VALUES("Q005","Carbohydrates are\n","polyhydroxy aldehydes and phenols\n","polyhydroxy aldehydes and ketones\n","polyhydroxy ketones and phenols\n","polyhydroxy phenols and alcohols\n","Biology1","S001");
INSERT INTO obj_questions VALUES("Q006","Structural polysaccharides include\n","cellulose, hemicellulose and chitin\n","cellulose, starch and chitin\n","cellulose, starch and glycogen\n","cellulose, glycogen and chitin\n","Biology1","S001");
INSERT INTO obj_questions VALUES("Q007","Nutritional polysaccharides are\n","starch and glycogen\n","starch and chitin\n","starch and cellulose\n","starch and glucose\n","Biology1","S001");
INSERT INTO obj_questions VALUES("Q008","Glycogen in animals are stored in \n","liver and spleen\n","liver and muscles\n","liver and bile\n","liver and adipose tissue\n","Biology1","S001");
INSERT INTO obj_questions VALUES("Q009","Carbohydrates accounts\n","30% in plants and 20% in animals\n","30% in plants and 10% in animals\n","30% in plants and 1% in animals\n","50% in plants and 50% in animals\n","Biology1","S001");
INSERT INTO obj_questions VALUES("Q010","Smallest carbohydrates are trioses. Which of the following is a triose?\n","glucose\n","ribulose\n","ribose\n","glyceraldehyde\n","Biology1","S001");
INSERT INTO obj_questions VALUES("Q021","What is D?","Ans A","Ans B","Ans C","Ans D","Topic1","S001");
INSERT INTO obj_questions VALUES("Q022","What is Tiesto?","Ans A","Ans B","Ans C","Ans D","Topic2","S001");
INSERT INTO obj_questions VALUES("Q025","The nucleus of an atom consists of\n","electrons and neutrons\n","electrons and protons\n","protons and neutrons\n","All of the above\n","Topic2","S001");
INSERT INTO obj_questions VALUES("Q026","The number of moles of solute present in 1 kg of a solvent is called its\n","molality\n","molarity\n","normality\n","formality\n","Topic2","S001");
INSERT INTO obj_questions VALUES("Q027","The most electronegative element among the following is\n","sodium\n","bromine\n","fluorine\n","oxygen\n","Topic2","S001");
INSERT INTO obj_questions VALUES("Q028","The number of d-electrons in Fe2+ (Z = 26) is not equal to that of\n","p-electrons in Ne(Z = 10)\n","s-electrons in Mg(Z = 12)\n","d-electrons in Fe(Z = 26)\n","p-electrons in CI(Z = 17)\n","Topic2","S001");
INSERT INTO obj_questions VALUES("Q029","The metal used to recover copper from a solution of copper sulphate is\n","Na\n","Ag\n","Hg\n","Fe\n","Topic2","S001");
INSERT INTO obj_questions VALUES("Q030","The metallurgical process in which a metal is obtained in a fused state is called\n","smelting\n","roasting\n","calcinations\n","froth floatation\n","Topic2","S001");



DROP TABLE IF EXISTS obj_answers;

CREATE TABLE `obj_answers` (
  `question_id` varchar(50) NOT NULL,
  `ans` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`question_id`),
  CONSTRAINT `obj_question_id` FOREIGN KEY (`question_id`) REFERENCES `obj_questions` (`question_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO obj_answers VALUES("Q001","Sodium bicarbonate\n");
INSERT INTO obj_answers VALUES("Q002","carbohydrates\n");
INSERT INTO obj_answers VALUES("Q003","both a and b\n");
INSERT INTO obj_answers VALUES("Q004","(CH2O)n\n");
INSERT INTO obj_answers VALUES("Q005","polyhydroxy aldehydes and ketones\n");
INSERT INTO obj_answers VALUES("Q006","cellulose, hemicellulose and chitin\n");
INSERT INTO obj_answers VALUES("Q007","starch and glycogen\n");
INSERT INTO obj_answers VALUES("Q008","liver and spleen\n");
INSERT INTO obj_answers VALUES("Q009","30% in plants and 1% in animals\n");
INSERT INTO obj_answers VALUES("Q010","glyceraldehyde\n");
INSERT INTO obj_answers VALUES("Q021","Ans A");
INSERT INTO obj_answers VALUES("Q022","Ans B");
INSERT INTO obj_answers VALUES("Q025","protons and neutrons\n");
INSERT INTO obj_answers VALUES("Q026","molality\n");
INSERT INTO obj_answers VALUES("Q027","fluorine\n");
INSERT INTO obj_answers VALUES("Q028","p-electrons in CI(Z = 17)\n");
INSERT INTO obj_answers VALUES("Q029","Fe\n");
INSERT INTO obj_answers VALUES("Q030","smelting\n");



DROP TABLE IF EXISTS q_id;

CREATE TABLE `q_id` (
  `last_id` varchar(50) NOT NULL,
  PRIMARY KEY (`last_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO q_id VALUES("32");



DROP TABLE IF EXISTS quiz_detail;

CREATE TABLE `quiz_detail` (
  `quiz_id` varchar(50) NOT NULL,
  `quiz_title` varchar(50) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `no_of_questions` int(11) NOT NULL,
  `quiz_status` varchar(50) DEFAULT NULL,
  `quiz_type` int(11) DEFAULT NULL,
  `timelimit` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`quiz_id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO quiz_detail VALUES("QUIZ001","Week 12 Quiz","U002","6","6","Open","1","11","2013-11-12 16:37:50","2013-11-12 17:59:58");
INSERT INTO quiz_detail VALUES("QUIZ002","Week 5 Quiz","U002","50","5","Open","2","10","2013-11-12 17:16:30","2013-11-12 18:15:00");
INSERT INTO quiz_detail VALUES("QUIZ003","Week 16 Quiz","U002","33","6","Open","3","10","2013-11-12 18:15:40","2013-11-12 18:18:59");



DROP TABLE IF EXISTS quiz_assignment;

CREATE TABLE `quiz_assignment` (
  `user_id` varchar(50) NOT NULL,
  `quiz_id` varchar(50) NOT NULL DEFAULT '',
  `quiz_status` varchar(50) DEFAULT NULL,
  `ass_status` varchar(50) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO quiz_assignment VALUES("U003","QUIZ001","Open","Marked","0");
INSERT INTO quiz_assignment VALUES("U003","QUIZ002","Open","Marked","0");
INSERT INTO quiz_assignment VALUES("U003","QUIZ003","Open","Unmarked","0");
INSERT INTO quiz_assignment VALUES("U006","QUIZ001","Open","Assigned","0");
INSERT INTO quiz_assignment VALUES("U006","QUIZ002","Open","Assigned","0");
INSERT INTO quiz_assignment VALUES("U006","QUIZ003","Open","Assigned","0");
INSERT INTO quiz_assignment VALUES("U010","QUIZ001","Open","Assigned","0");
INSERT INTO quiz_assignment VALUES("U010","QUIZ002","Open","Assigned","0");
INSERT INTO quiz_assignment VALUES("U010","QUIZ003","Open","Assigned","0");



DROP TABLE IF EXISTS quiz_questions;

CREATE TABLE `quiz_questions` (
  `question_id` varchar(50) NOT NULL,
  `quiz_id` varchar(50) NOT NULL,
  `question_type` varchar(10) NOT NULL,
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO quiz_questions VALUES("Q005","QUIZ001","obj");
INSERT INTO quiz_questions VALUES("Q006","QUIZ001","obj");
INSERT INTO quiz_questions VALUES("Q007","QUIZ001","obj");
INSERT INTO quiz_questions VALUES("Q008","QUIZ001","obj");
INSERT INTO quiz_questions VALUES("Q009","QUIZ001","obj");
INSERT INTO quiz_questions VALUES("Q010","QUIZ001","obj");
INSERT INTO quiz_questions VALUES("Q011","QUIZ002","sub");
INSERT INTO quiz_questions VALUES("Q012","QUIZ002","sub");
INSERT INTO quiz_questions VALUES("Q013","QUIZ002","sub");
INSERT INTO quiz_questions VALUES("Q014","QUIZ002","sub");
INSERT INTO quiz_questions VALUES("Q015","QUIZ002","sub");
INSERT INTO quiz_questions VALUES("Q003","QUIZ003","obj");
INSERT INTO quiz_questions VALUES("Q006","QUIZ003","obj");
INSERT INTO quiz_questions VALUES("Q007","QUIZ003","obj");
INSERT INTO quiz_questions VALUES("Q012","QUIZ003","sub");
INSERT INTO quiz_questions VALUES("Q018","QUIZ003","sub");
INSERT INTO quiz_questions VALUES("Q019","QUIZ003","sub");



DROP TABLE IF EXISTS results;

CREATE TABLE `results` (
  `user_id` varchar(50) NOT NULL,
  `quiz_id` varchar(50) NOT NULL,
  `question_id` varchar(50) NOT NULL DEFAULT '',
  `answer_given` text,
  `marks_scored` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`quiz_id`,`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO results VALUES("U003","QUIZ001","Q005","","0");
INSERT INTO results VALUES("U003","QUIZ001","Q006","","0");
INSERT INTO results VALUES("U003","QUIZ001","Q007","","0");
INSERT INTO results VALUES("U003","QUIZ001","Q008","","0");
INSERT INTO results VALUES("U003","QUIZ001","Q009","","0");
INSERT INTO results VALUES("U003","QUIZ001","Q010","","0");
INSERT INTO results VALUES("U003","QUIZ002","Q011","","0");
INSERT INTO results VALUES("U003","QUIZ002","Q012","","0");
INSERT INTO results VALUES("U003","QUIZ002","Q013","","0");
INSERT INTO results VALUES("U003","QUIZ002","Q014","","0");
INSERT INTO results VALUES("U003","QUIZ002","Q015","","0");
INSERT INTO results VALUES("U003","QUIZ003","Q003","","0");
INSERT INTO results VALUES("U003","QUIZ003","Q006","","0");
INSERT INTO results VALUES("U003","QUIZ003","Q007","","0");
INSERT INTO results VALUES("U003","QUIZ003","Q012","","0");
INSERT INTO results VALUES("U003","QUIZ003","Q018","","0");
INSERT INTO results VALUES("U003","QUIZ003","Q019","","0");



DROP TABLE IF EXISTS sub_questions;

CREATE TABLE `sub_questions` (
  `question_id` varchar(50) NOT NULL,
  `question_text` text,
  `question_mark` int(11) DEFAULT NULL,
  `topic` varchar(50) NOT NULL,
  `mod_id` varchar(50) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO sub_questions VALUES("Q011","Cyclobutyl bromide on treatment with magnesium in dry ether forms an organometallic (A). The organometallic reacts with ethanal to give an alcohol (B) after mild acidification. Prolonged treatment of alcohol (B) with an equivalent amount of HBr gives 1-bromo-1-methylcyclopentane (C). Write the structures of (A), (B) and explain how (C) is obtained from (B).\n<br/>Please explain your answer using diagram\n","10","Week 3","S001");
INSERT INTO sub_questions VALUES("Q012","A hydrocarbon (A) of molecular weight 54 reacts with an excess of Br2 in CCl4 to give a compound (B) whose molecular weight is 593% more than of (A). However, on catalytic hydrogenation with excess of hydrogen, (A) forms (C) whose molecular weight is only 7.4% more than that of (A). (A) reacts with CH3CH2Br in the presence of NaNH2 to give another hydrocarbon (D) which on ozonolysis yields diketone (E). (E) on oxidation gives propanoic acid. Give structures of (A) to (E) with reasons.\n<br/>Please explain your answer briefly\n","10","Week 3","S001");
INSERT INTO sub_questions VALUES("Q013","Why is that Lithium salts have a greater degree of covalent character than other halides of the alkali metal.\n<br/>Please explain your answer briefly\n","10","Week 3","S001");
INSERT INTO sub_questions VALUES("Q014","Dipole moment of HX is 2.59 ´ 10–30 coulomb-metre. Bond length of HX is 1.39Å. Calculate percentage ionic character of molecule.\n<br/>Please explain your answer briefly\n","10","Week 3","S001");
INSERT INTO sub_questions VALUES("Q015","Draw the molecular structures of XeF2 and  XeF4, indicating the location of lone pair(s) of electrons.\n<br/>Please explain your answer using diagram\n","10","Week 3","S001");
INSERT INTO sub_questions VALUES("Q016","In trimethylamine, the nitrogen has a pyramidal geometry whereas in trisilylamine N(SiH3)3, it has a planar geometry. What is the reason behind this ?\n<br/>Please explain your answer briefly\n","10","Week 3","S001");
INSERT INTO sub_questions VALUES("Q017","A diatomic molecule has a dipole moment of 1.2D. If its bond distance is 1.0Å. What fraction of an electronic charge exist on each atom?\n<br/>Provide calculation below\n","10","Week 3","S001");
INSERT INTO sub_questions VALUES("Q018","Though Cs is most electropositive element in periodic table, Li has highest oxidation potential why?\n<br/>Please explain your answer briefly\n","10","Week 3","S001");
INSERT INTO sub_questions VALUES("Q019","Explain why bond angle of NH3 is greater than NF3 while bond angle of PH3 is less than that of PF3.\n<br/>Please explain your answer briefly\n","10","Week 3","S001");
INSERT INTO sub_questions VALUES("Q020","The bond angle of H2O is 104° while that of F2O is 102°.\n<br/>Please explain your answer briefly\n","10","Week 3","S001");
INSERT INTO sub_questions VALUES("Q023","Question<br />\nTesting","15","Topic2","S001");
INSERT INTO sub_questions VALUES("Q024","Testing Number one<br />\ntesting number two","12","Topic2","S001");



DROP TABLE IF EXISTS topics;

CREATE TABLE `topics` (
  `mod_id` varchar(50) NOT NULL,
  `topic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS mod_assignment;

CREATE TABLE `mod_assignment` (
  `user_id` varchar(50) NOT NULL,
  `mod_id` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  KEY `mod_index` (`user_id`,`mod_id`),
  KEY `mod_id_idx` (`mod_id`),
  CONSTRAINT `mod_id_fk` FOREIGN KEY (`mod_id`) REFERENCES `modules` (`mod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `mod_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO mod_assignment VALUES("U002","S001","2");
INSERT INTO mod_assignment VALUES("U003","S001","3");
INSERT INTO mod_assignment VALUES("U003","S002","3");
INSERT INTO mod_assignment VALUES("U006","S001","3");
INSERT INTO mod_assignment VALUES("U006","S002","3");
INSERT INTO mod_assignment VALUES("U005","S002","2");
INSERT INTO mod_assignment VALUES("U009","S002","2");
INSERT INTO mod_assignment VALUES("U010","S001","3");
INSERT INTO mod_assignment VALUES("U010","S002","3");



