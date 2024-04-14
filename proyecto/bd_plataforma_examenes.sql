CREATE DATABASE `bd_plataforma_examenes` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE bd_plataforma_examenes;
-- Creación de tablas
CREATE TABLE Categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE Subcategorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    categoria_id INT NOT NULL,
    
    FOREIGN KEY (categoria_id) REFERENCES Categorias(id) ON DELETE RESTRICT
);


CREATE TABLE Dificultades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE TiposPreguntas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE Preguntas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT,
    subcategoria_id INT,
    dificultad_id INT,
    tipo_pregunta_id INT,
    pregunta TEXT NOT NULL,
    descripcion TEXT,
    pistas TEXT,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE RESTRICT,
	FOREIGN KEY (subcategoria_id) REFERENCES subcategorias(id) ON DELETE RESTRICT,
    FOREIGN KEY (dificultad_id) REFERENCES dificultades(id) ON DELETE RESTRICT,
    FOREIGN KEY (tipo_pregunta_id) REFERENCES tiposPreguntas(id) ON DELETE RESTRICT
);


CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    tipo_permiso ENUM('Administrador', 'Docente') NOT NULL
);

-- Categorias
INSERT INTO categorias ( id, nombre)
VALUES
(1,"Lenguaje de marcas"),
(2,"Programacion"),
(3,"Sistemas"),
(4,"Base de datos");
-- Dificultades
INSERT INTO dificultades (id ,nombre)
VALUES
(1,"Facil"),
(2,"Normal"),
(3,"Medio"),
(4,"Dificil"),
(5,"Muy Dificil");

-- Subcategorias
INSERT INTO subcategorias (id,nombre,categoria_id)
VALUES
(1,"HTML",1),
(2,"CSS",1),
(3,"PHP",1),
(4,"JavaScript",1),
(5,"Java",2),
(6,"Windows",3),
(7,"Xubuntu",3),
(8,"MySQL",4);
-- Tipos Preguntas
INSERT INTO tipospreguntas (id,nombre)
VALUES
(1,"Test respuesta simple"),
(2,"Test respuesta multiple"),
(3,"Desarrollo"),
(4,"Verdadero / Falso");
-- Usuarios
INSERT INTO usuarios (id,nombre,correo,contraseña,tipo_permiso)
VALUES
(1,"profesor","profesor@centroestudio.es",123456,"Docente"),
(2,"director","director@centroestudio.es",123456,"Administrador");
-- Preguntas
INSERT INTO preguntas (id,categoria_id,subcategoria_id,dificultad_id,tipo_pregunta_id,pregunta,descripcion,pistas)
VALUES
(1,1,1,1,1,"Aáklngñadng´ka´nfgadn´gad´fgknadlkgfnagfjnañf,m vña","akngóanfgád,mdfglkjalsdkngñadmb afgjnalgmáldsgfnñngbamfdngamlfdgñjlkandfñgklangñ","sñagñadnfgñjnañdfgnñagf"),
(2,3,7,4,4,"ñioajngñafgnñadfkgnñadfngñankgf","na´glamdñgfland´lgakdnñgf,amld,nòangñadsfngñakdngfñajngbñamgnfñajngfdñkjanbdgñ","asndgfñkadgfnñakdfgjnñamdfgnñajgfd"),
(3,2,5,3,2,"lkjsngfñadknjgfñangfñang´fakgf","	dadf´lgkmna´lgkma´lgfdka´dfa´ldgfka´lgdfkna´ldfmg´lakndgf´lakngdf´lamdg´lakndsg´fanfgñlknagñf","afngñalkngfñanfg´ñ"),
(4,1,3,4,4,"alkgdfnañkdfgnjñafnmgñafgn","añlngñnañgfnañklfgnañlkfgnñanfñkm gkjabñnghamfdngñ","afñgknañfgkanñgfkjnañfgnañgjfnbañdjfgbalkdfmn gñkajbnfdñgmknañfgjnbañfgjnbañl"),
(5,4,8,2,3,"lajkbgfñpajnfgñkangfñkanfgñakdnfñgmandñfgjnqñ","adñfgnñafngñakjfngñamdfngñkdanfgñamndñfgjnañdfmgnñajngñamgn","ñafngñkangfñkajndsfñgmandñgjfnañdfmkgnñajdfngñmnañgbanñgfmnafñg"),
(6,1,4,4,3,"añijgnafgjnañkmgfñpangfñlanfgñkangfñkangñfkamñfkjnañfdgmnñkang","ñankgfñkangfñpkanñgm apñnfgñkutaknñmfangpñijanñdfmgknpqibñafngpñajñapigbañjadspñjkñan jadnhfgñ kjanfkn ñkandsfpñ iñadk fnpñ","agfjnañgjfnñlakjf "),
(7,2,5,3,2,"ljagfnñaknjfdñangfdñkangfñadnfgñadkngadnñangñadnjg","ñandfgñakngñakjnfdñamngfdñkanjgfñandñfgmanñgdkjnañdsgfmnjnbñgjanñdgfjbnañf","ñangfñangñjanbgñamndñfjbnañsdgfaksdng"),
(8,1,2,5,3,"pangàgnfaklfngadfgádmf´glnad´lfgkna ´nal´fgka´lkdfg añlkdfnñasdjfn ñasdnfñ ksandfñkasndñf nasñdfnañdgf","ñalgdfn ñakmd fnñasndfñasdnfñ sa dmfñka nsdñkfjnasdñfkjañpdfa","ñjfag nñdkafng ñ aknds fñasndñf janñsdf añah dsñf"),
(9,3,7,3,4,"añlkfgnadñgkfnadñfgknadñfgknmañfgnmadñfgbnj","adfgñladkngfñkdangfñkdanfgñafngñ","adñfgnañdfgnañdkfgnñadkfgnbñadkfgnafga"),
(10,3,6,5,3,"asdfasfdgadfgadsgfa","dfasdgadfghadfgadfga","aghagdfasfgadsfghadfgasdf"),
(11,1,1,1,1,"dgfasdfadgadfgadgadfgadd","gadgfadfgadfgadfgadghadfghadfgasdfasdf","asgadfgadsfasdfadfghadfgaggf");
