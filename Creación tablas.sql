CREATE TABLE Categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    categoria_padre_id INT,
    FOREIGN KEY (categoria_padre_id) REFERENCES Categorias(id) ON DELETE CASCADE
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
    dificultad_id INT,
    tipo_pregunta_id INT,
    pregunta TEXT NOT NULL,
    descripcion TEXT,
    pistas TEXT,
    FOREIGN KEY (categoria_id) REFERENCES Categorias(id) ON DELETE CASCADE,
    FOREIGN KEY (dificultad_id) REFERENCES Dificultades(id) ON DELETE CASCADE,
    FOREIGN KEY (tipo_pregunta_id) REFERENCES TiposPreguntas(id) ON DELETE CASCADE
);

CREATE TABLE Profesores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    tipo_permiso ENUM('Administrador', 'Docente') NOT NULL
);

CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    tipo_permiso ENUM('Administrador', 'Docente') NOT NULL
);