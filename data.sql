-- Base de datos para la academia
CREATE DATABASE academia;
USE academia;

-- Tabla de usuarios para autenticación
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    tipo ENUM('admin', 'tutor') NOT NULL,
    codigo_tutor VARCHAR(10) NULL
);

-- Tabla de tutores
CREATE TABLE tutores (
    codigo VARCHAR(10) PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    dui VARCHAR(10) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    fecha_contratacion DATE NOT NULL,
    estado ENUM('contratado', 'despedido', 'renuncia') DEFAULT 'contratado'
);

-- Tabla de estudiantes
CREATE TABLE estudiantes (
    codigo VARCHAR(15) PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    dui VARCHAR(10) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    fotografia VARCHAR(255) NULL,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo'
);

-- Tabla de grupos
CREATE TABLE grupos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    codigo_tutor VARCHAR(10) NOT NULL,
    FOREIGN KEY (codigo_tutor) REFERENCES tutores(codigo)
);

-- Tabla de asignación de estudiantes a grupos
CREATE TABLE grupo_estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    grupo_id INT NOT NULL,
    codigo_estudiante VARCHAR(15) NOT NULL,
    FOREIGN KEY (grupo_id) REFERENCES grupos(id),
    FOREIGN KEY (codigo_estudiante) REFERENCES estudiantes(codigo)
);

-- Tabla de aspectos
CREATE TABLE aspectos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion TEXT NOT NULL,
    tipo ENUM('P', 'L', 'G', 'MG') NOT NULL
);

-- Tabla de asistencias
CREATE TABLE asistencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    codigo_estudiante VARCHAR(15) NOT NULL,
    codigo_tutor VARCHAR(10) NOT NULL,
    tipo ENUM('A', 'I', 'J') NOT NULL,
    FOREIGN KEY (codigo_estudiante) REFERENCES estudiantes(codigo),
    FOREIGN KEY (codigo_tutor) REFERENCES tutores(codigo)
);

-- Tabla de asignación de aspectos
CREATE TABLE asignacion_aspectos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_aspecto INT NOT NULL,
    fecha DATE NOT NULL,
    codigo_estudiante VARCHAR(15) NOT NULL,
    codigo_tutor VARCHAR(10) NOT NULL,
    FOREIGN KEY (codigo_aspecto) REFERENCES aspectos(id),
    FOREIGN KEY (codigo_estudiante) REFERENCES estudiantes(codigo),
    FOREIGN KEY (codigo_tutor) REFERENCES tutores(codigo)
);

-- Datos de ejemplo
INSERT INTO usuarios VALUES 
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL),
(2, 'tutor01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tutor', 'GA01');

INSERT INTO tutores VALUES 
('GA01', 'Juan Carlos', 'García López', '12345678-9', 'juan.garcia@email.com', '7890-1234', '1985-03-15', '2024-01-15', 'contratado'),
('MR02', 'María Elena', 'Rodríguez Pérez', '98765432-1', 'maria.rodriguez@email.com', '7890-5678', '1990-07-22', '2024-01-20', 'contratado');

INSERT INTO estudiantes VALUES 
('GA20251', 'Pedro Antonio', 'González Martínez', '11111111-1', 'pedro.gonzalez@email.com', '7111-1111', '2010-05-10', NULL, 'activo'),
('LO20252', 'Ana María', 'López Hernández', '22222222-2', 'ana.lopez@email.com', '7222-2222', '2011-08-15', NULL, 'activo');

INSERT INTO aspectos VALUES 
(1, 'Completa sus actividades con puntualidad', 'P'),
(2, 'Participa activamente en clase', 'P'),
(3, 'Plática en clase', 'L'),
(4, 'No trae materiales', 'L'),
(5, 'Falta de respeto al compañero', 'G');

INSERT INTO grupos VALUES (1, 'Grupo A - Primer Trimestre', 'GA01');

INSERT INTO grupo_estudiantes VALUES 
(1, 1, 'GA20251'),
(2, 1, 'LO20252');