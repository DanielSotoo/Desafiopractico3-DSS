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

--Datos faltantes

INSERT INTO tutores VALUES 
('TU03', 'Rodrigo Marcelo', 'Gonzales Perez', '24258389-8', 'rodrigo.gonzales@gmail.com', '7042-2734', '1978-11-26', '2025-02-08', 'contratado'),
('TU04', 'Marlon Martin', 'Bayona Hernández', '96876177-6', 'marlon.bayona@gmail.com', '6840-1875', '1980-03-29', '2024-08-31', 'contratado'),
('TU05', 'Pedro Antonio', 'Sánchez López', '73284645-4', 'antonio.sanchez@gmail.com', '6147-2234', '1975-05-13', '2024-11-12', 'contratado');

INSERT INTO estudiantes VALUES
('ST202503', 'Feliciana Dani', 'Amaya Llopis', '95822412-1', 'feliciana.llopis@email.com', '6051-5506', '2011-06-10', NULL, 'activo'),
('ST202504', 'Jacinto Emilio', 'Calatayud Bonet', '42868828-3', 'jacinto.bonet@email.com', '6285-2679', '2012-11-28', NULL, 'activo'),
('ST202505', 'Telmo Amílcar', 'Andrés Bueno', '83197857-1', 'telmo.bueno@email.com', '7209-7912', '2011-04-30', NULL, 'activo'),
('ST202506', 'Joan Anselma', 'Amor Flor', '14265799-0', 'joan.flor@email.com', '6191-4582', '2013-02-28', NULL, 'activo'),
('ST202507', 'Judith Caridad', 'Rivas Giménez', '41227216-8', 'judith.giménez@email.com', '7232-1434', '2012-04-22', NULL, 'activo'),
('ST202508', 'Dolores Leopoldo', 'Agudo Cuervo', '85329037-3', 'dolores.cuervo@email.com', '7466-9928', '2013-05-14', NULL, 'activo'),
('ST202509', 'Telmo Noé', 'Lobo Cortés', '66306997-3', 'telmo.cortés@email.com', '6919-5557', '2011-04-25', NULL, 'activo'),
('ST202510', 'María Carmen Nicodemo', 'Calatayud Bru', '99810521-0', 'maría.bru@email.com', '6695-1098', '2011-05-19', NULL, 'activo'),
('ST202511', 'Adán Silvestre', 'García Suárez', '71932848-2', 'adán.suárez@email.com', '6230-2396', '2013-08-26', NULL, 'activo'),
('ST202512', 'Gabriela Encarna', 'Ortiz Alarcón', '44919424-0', 'gabriela.alarcón@email.com', '6824-3413', '2012-01-27', NULL, 'activo'),
('ST202513', 'Andrea Abelardo', 'Estévez Otero', '79203709-7', 'andrea.otero@email.com', '6483-6465', '2013-02-01', NULL, 'activo'),
('ST202514', 'Verónica Bartolomé', 'Ortega Fajardo', '82783783-5', 'verónica.fajardo@email.com', '7167-3370', '2011-04-06', NULL, 'activo'),
('ST202515', 'Vicente Antonio', 'Rey Antúnez', '65528748-0', 'vicente.antúnez@email.com', '7685-7801', '2013-06-21', NULL, 'activo'),
('ST202516', 'Candelaria Elías', 'Roig De la Fuente', '16932824-4', 'candelaria.fuente@email.com', '7438-7907', '2013-06-14', NULL, 'activo'),
('ST202517', 'Teodoro Damián', 'Cano Arroyo', '88044869-9', 'teodoro.arroyo@email.com', '6482-6633', '2012-09-25', NULL, 'activo'),
('ST202518', 'Susana Germán', 'Andrés Alcántara', '56423695-6', 'susana.alcántara@email.com', '7227-5683', '2012-09-10', NULL, 'activo'),
('ST202519', 'Elena Omar', 'Amaya Cuéllar', '20370050-6', 'elena.cuéllar@email.com', '6795-3589', '2011-05-01', NULL, 'activo'),
('ST202520', 'Dora Segundo', 'Aparicio Parra', '98518769-5', 'dora.parra@email.com', '6735-1790', '2013-10-01', NULL, 'activo'),
('ST202521', 'Dolores Arturo', 'Benítez Pardo', '84929094-5', 'dolores.pardo@email.com', '6847-8793', '2012-06-17', NULL, 'activo'),
('ST202522', 'Rafael Mateo', 'Collado Cuevas', '29821996-9', 'rafael.cuevas@email.com', '7390-1952', '2011-12-14', NULL, 'activo'),
('ST202523', 'Daniela Abelardo', 'Esteban Acosta', '72852118-6', 'daniela.acosta@email.com', '7174-3613', '2011-04-18', NULL, 'activo'),
('ST202524', 'Alejandro César', 'Benítez Cuesta', '30466739-1', 'alejandro.cuesta@email.com', '6401-9195', '2011-06-20', NULL, 'activo'),
('ST202525', 'Enrique Alba', 'Bravo Expósito', '70999211-7', 'enrique.expósito@email.com', '6955-1689', '2011-06-11', NULL, 'activo'),
('ST202526', 'Domingo Zacarías', 'Del Río Barragán', '61710123-4', 'domingo.barragán@email.com', '6761-6209', '2011-11-10', NULL, 'activo'),
('ST202527', 'Gonzalo Cristino', 'Amaya Franco', '41280281-7', 'gonzalo.franco@email.com', '6453-7412', '2012-06-17', NULL, 'activo'),
('ST202528', 'Álvaro Andrés', 'Campos Ríos', '87694750-6', 'álvaro.ríos@email.com', '6072-4330', '2013-01-25', NULL, 'activo'),
('ST202529', 'Concepción Leandro', 'Gil Villanueva', '32740429-2', 'concepción.villanueva@email.com', '6862-2221', '2013-10-13', NULL, 'activo'),
('ST202530', 'Milagros Pedro', 'Arias Ferrer', '78524349-2', 'milagros.ferrer@email.com', '6453-7775', '2013-01-14', NULL, 'activo'),
('ST202531', 'María Jesús Zacarías', 'Benítez Cano', '29249221-1', 'maría.cano@email.com', '6693-1967', '2013-02-26', NULL, 'activo'),
('ST202532', 'Sofía Andrés', 'Herrera García', '31605517-6', 'sofía.garcía@email.com', '6585-6646', '2012-08-12', NULL, 'activo'),
('ST202533', 'Teodoro Ángela', 'Fajardo Ferrer', '70130493-3', 'teodoro.ferrer@email.com', '7706-9970', '2011-12-04', NULL, 'activo'),
('ST202534', 'Consuelo Ángel', 'Marín Franco', '80069333-7', 'consuelo.franco@email.com', '6366-7762', '2011-07-23', NULL, 'activo'),
('ST202535', 'Luis Mario', 'Rubio Rivas', '22423621-5', 'luis.rivas@email.com', '6145-1796', '2011-11-11', NULL, 'activo'),
('ST202536', 'Raquel Cruz', 'Carrasco Jurado', '32361576-3', 'raquel.jurado@email.com', '7260-8926', '2012-11-19', NULL, 'activo'),
('ST202537', 'Celia Jesús', 'Del Río Gracia', '78704314-6', 'celia.gracia@email.com', '7232-2011', '2012-06-11', NULL, 'activo'),
('ST202538', 'Jesús Francisco', 'Molina Cabrera', '96189418-3', 'jesús.cabrera@email.com', '7777-9407', '2012-12-09', NULL, 'activo'),
('ST202539', 'Noemí César', 'Ortega Díaz', '26816223-3', 'noemí.díaz@email.com', '6142-8816', '2012-11-24', NULL, 'activo'),
('ST202540', 'Rosario Jesús', 'Esteban Vera', '94621832-2', 'rosario.vera@email.com', '6676-5843', '2012-01-04', NULL, 'activo');

INSERT INTO aspectos (descripcion, tipo) VALUES
('Muestra iniciativa para aprender', 'P'),
('Ayuda a sus compañeros cuando tienen dudas', 'P'),
('Respeta las normas del aula', 'P');
('No presta atención en clase', 'L'),
('Interrumpe constantemente', 'L'),
('Llega tarde al aula', 'L');
('Falta de respeto al docente', 'G'),
('Se niega a realizar las actividades', 'G'),
('Uso inapropiado del lenguaje', 'G'),
('Se burla de sus compañeros', 'G');
('Agresión física a un compañero', 'MG'),
('Robo de pertenencias ajenas', 'MG'),
('Amenazas dentro del aula', 'MG'),
('Destrucción de material escolar', 'MG'),
('Abandono del centro sin autorización', 'MG');
