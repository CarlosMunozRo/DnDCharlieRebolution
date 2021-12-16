DROP DATABASE IF EXISTS `DungeonsAndDragons`;

CREATE DATABASE `DungeonsAndDragons`;

USE `DungeonsAndDragons`;

CREATE TABLE PropiedadesArma (
    NombrePropiedadArma varchar(30) PRIMARY KEY,
    Descripcion varchar(1000) not null
);
CREATE TABLE Armas_PropiedadesArma (
    NombreArma varchar(30) not null,
    NombrePropiedadArma varchar(30) not null
);
CREATE TABLE Usuarios (
    UsuarioID INT AUTO_INCREMENT PRIMARY KEY,
    NombreUsuario varchar(30) not null,
    FechaNacimiento date not null,
    Password varchar(257) not null,
    Email varchar(50) not null
);
CREATE TABLE Armas (
    NombreArma varchar(30) PRIMARY KEY,
    TipoArma varchar(100) not null,
    Coste varchar(20),
    Dano varchar(20) not null,
    TipoDano varchar(20) not null,
    Peso int
);
CREATE TABLE Armaduras (
    NombreArmadura varchar(30) PRIMARY KEY,
    TipoArmadura varchar(20) not null,
    Coste varchar(20),
    CA int not null,
    MaximoDestreza int,
    RequisitoFuerza int,
    Sigilo varchar(20),
    Peso int
);
CREATE TABLE Objetos (
    NombreObjeto varchar(20) PRIMARY KEY,
    Descripcion varchar(1000),
    Coste varchar(20),
    Peso int
);
CREATE TABLE Conjuros (
    NombreConjuro varchar(30) PRIMARY KEY,
    TiempoLanzamiento varchar(30) not null,
    Alcance varchar(100) not null,
    Componentes varchar(50) not null,
    Duracion varchar(50) not null,
    Descripcion varchar(5000) not null,
    Salvacion varchar(20)
);
CREATE TABLE Dotes (
    NombreDote varchar(30) PRIMARY KEY,
    Requisito varchar(100),
    Descripcion varchar(2000) not null
);
CREATE TABLE Usuarios_Personajes (
    UsuarioID int not null,
    PersonajeID int not null
);
CREATE TABLE Personajes_armas (
    PersonajeID int not null,
    NombreArma varchar(30) not null
);
CREATE TABLE Personajes_Armaduras (
    PersonajeID int not null,
    NombreArmadura varchar(30) not null
);
CREATE TABLE Personajes_Objetos (
    PersonajeID int not null,
    NombreObjeto varchar(20) not null
);
CREATE TABLE Personajes_Conjuros (
    PersonajeID int not null,
    NombreConjuro varchar(30) not null
);
CREATE TABLE Personajes_Dotes (
    PersonajeID int not null,
    NombreDote varchar(30) not null    
);
CREATE TABLE Personajes (
    PersonajeID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(50),
    Clase varchar(20),
    Trasfondo varchar(50),
    Raza varchar(20),
    Alineamiento varchar(20),
    Experiencia int,
    RasgosPersonalidad varchar(200),
    Ideales varchar(200),
    Vinculos varchar(200),
    Defectos varchar(200),
    Nivel int,
    PGMaximos int,
    CA int,
    Fuerza int,
    Destreza int,
    Constitucion int,
    inteligencia int,
    Sabiduria int,
    Carisma int,
    RasgosAtributos varchar(1000)
);
CREATE TABLE Trasfondo (
    Nombre varchar(30) PRIMARY KEY,
    Descripcion varchar(1000) not null,
    HabilidadesAdicionales varchar(50),
    LenguajeAdicional varchar(50),
    Herramientas varchar(200)
);
CREATE TABLE Razas (
    NombreRaza varchar(30) PRIMARY KEY,
    IncrementoEstadistica varchar(300) not null,
    Dimension varchar(20),
    Velocidad int(10),
    Vision varchar(300),
    RazaPadre varchar(30)
);
CREATE TABLE Clases (
    NombreClase varchar(30) PRIMARY KEY,
    Descripcion varchar(1000) not null,
    DG int not null,
    CaracteristicaPrimaria varchar(20) not null,
    CompetenciasSalvacion varchar(30) not null,
    CompetenciasArmas varchar(100),
    CompetenciasArmaduras varchar(200),
    EquipoInicial varchar(200),
    Rasgos varchar(50),
    TrucosConocidos int,
    ConjurosConocidos int
);

CREATE TABLE Razas_HabilidadesRaciales (
    NombreRaza varchar(30) not null,
    NombreHabilidadRacial varchar(50) not null
);
CREATE TABLE Clases_HabilidadesClase (
    NombreClase varchar(30) not null,
    NombreHabilidadesClase varchar(50) not null
);
CREATE TABLE HabilidadesClase (
    NombreHabilidadesClase varchar(50) PRIMARY KEY,
    Descripcion varchar(1000)
);
CREATE TABLE HabilidadesRaciales (
    NombreHabilidadRacial varchar(50) PRIMARY KEY,
    Descripcion varchar(1000)
);
CREATE TABLE Razas_Idiomas (
    NombreRaza varchar(30) not null,
    NombreIdioma varchar(30) not null
);
CREATE TABLE Idiomas (
    NombreIdioma varchar(30) PRIMARY KEY
);
CREATE TABLE Clases_EspacioConjuros (
    NombreClase varchar(30) not null,
    Id int not null
);
CREATE TABLE EspacioConjuros (
    Id int PRIMARY KEY,
    NivelClase int not null,
    NumeroConjuros int not null
);
CREATE TABLE Clases_Armas_Armaduras_Objetos (
    NombreClase varchar(30),
    NombreArma varchar(30),
    NombreArmadura varchar(30),
    NombreObjeto varchar(30)
);

ALTER TABLE Clases_EspacioConjuros
ADD FOREIGN KEY (NombreClase) REFERENCES Clases(NombreClase);
ALTER TABLE Clases_EspacioConjuros
ADD FOREIGN KEY (Id) REFERENCES EspacioConjuros(Id);

ALTER TABLE Razas_Idiomas
ADD FOREIGN KEY (NombreRaza) REFERENCES Razas(NombreRaza);
ALTER TABLE Razas_Idiomas
ADD FOREIGN KEY (NombreIdioma) REFERENCES Idiomas(NombreIdioma);

ALTER TABLE Armas_PropiedadesArma
ADD FOREIGN KEY (NombreArma) REFERENCES Armas(NombreArma);
ALTER TABLE Armas_PropiedadesArma
ADD FOREIGN KEY (NombrePropiedadArma) REFERENCES PropiedadesArma(NombrePropiedadArma);

ALTER TABLE Usuarios_Personajes
ADD FOREIGN KEY (UsuarioID) REFERENCES Usuarios(UsuarioID);
ALTER TABLE Usuarios_Personajes
ADD FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID);

ALTER TABLE Personajes_armas
ADD FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID);
ALTER TABLE Personajes_armas
ADD FOREIGN KEY (NombreArma) REFERENCES Armas(NombreArma);

ALTER TABLE Personajes_Armaduras
ADD FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID);
ALTER TABLE Personajes_Armaduras
ADD FOREIGN KEY (NombreArmadura) REFERENCES Armaduras(NombreArmadura);

ALTER TABLE Personajes_Objetos
ADD FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID);
ALTER TABLE Personajes_Objetos
ADD FOREIGN KEY (NombreObjeto) REFERENCES Objetos(NombreObjeto);

ALTER TABLE Personajes_Conjuros
ADD FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID);
ALTER TABLE Personajes_Conjuros
ADD FOREIGN KEY (NombreConjuro) REFERENCES Conjuros(NombreConjuro);

ALTER TABLE Personajes_Dotes
ADD FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID);
ALTER TABLE Personajes_Dotes
ADD FOREIGN KEY (NombreDote) REFERENCES Dotes(NombreDote);

ALTER TABLE Clases_HabilidadesClase
ADD FOREIGN KEY (NombreClase) REFERENCES Clases(NombreClase);
ALTER TABLE Clases_HabilidadesClase
ADD FOREIGN KEY (NombreHabilidadesClase) REFERENCES HabilidadesClase(NombreHabilidadesClase);

ALTER TABLE Razas_HabilidadesRaciales
ADD FOREIGN KEY (NombreRaza) REFERENCES Razas(NombreRaza);
ALTER TABLE Razas_HabilidadesRaciales
ADD FOREIGN KEY (NombreHabilidadRacial) REFERENCES HabilidadesRaciales(NombreHabilidadRacial);

ALTER TABLE Clases_Armas_Armaduras_Objetos
ADD FOREIGN KEY (NombreClase) REFERENCES Clases(NombreClase);
ALTER TABLE Clases_Armas_Armaduras_Objetos
ADD FOREIGN KEY (NombreArma) REFERENCES Armas(NombreArma);
ALTER TABLE Clases_Armas_Armaduras_Objetos
ADD FOREIGN KEY (NombreArmadura) REFERENCES Armaduras(NombreArmadura);
ALTER TABLE Clases_Armas_Armaduras_Objetos
ADD FOREIGN KEY (NombreObjeto) REFERENCES Objetos(NombreObjeto);


INSERT INTO Usuarios (NombreUsuario,FechaNacimiento,Password,Email)
VALUES ('carlos','2000-02-28','AC9C2C34C9F7AD52528C3422AF40A66E2E24AAF2A727831255413C9470158984','carlos@gmail.com');

INSERT INTO Clases (NombreClase,Descripcion,DG,CaracteristicaPrimaria,CompetenciasSalvacion,CompetenciasArmas,CompetenciasArmaduras,EquipoInicial,Rasgos,TrucosConocidos,ConjurosConocidos)
VALUES ('Guerrero','Un maestro del combate marcial, competente con una gran variedad de armas y armaduras.',10,'fuerza o destreza','fuerza y contitucion','armas simples y marciales','todas',null,null,0,0),
('Mago','Un usuario de magia educado capaz de manipular la estructura de la realidad.',6,'Inteligencia','Inteligencia y sabiduria','Dagas, dorados, hondas, bastones, ballestas ligeras',null,null,null,3,0),
('Barbaro','La Furia es lo que define al Bárbaro. Una ira desenfrenada, insaciable e irreflexiva. No se trata de una simple emoción, pues esta ira es similar a la ferocidad del depredador acorralado, el asalto implacable de la tormenta o la agitada confusión del mar.',12,'Fuerza','Fuerza y contitucion','Armas sencillas, armas marciales','Todas las armaduras, escudos',null,null,0,0),
('Bardo','Un Bardo, ya sea este un erudito, un escaldo o un bribón, es capaz de tejer magia a través de sus palabras y su música, inspirando a sus aliados, desmoralizando a sus enemigos, manipulando mentes, creando ilusiones e incluso sanando heridas.',8,'Carisma','Carisma y destreza','Armas sencillas, ballestas de mano, espadas largas, estoques, espadas cortas','Armadura ligera',null,null,2,4),
('Brujo','Los Brujos buscan el conocimiento que yace escondido tras el tejido mismo del multiverso. A través de pactos forjados con misteriosos seres de poder sobrenatural, desvelan efectos mágicos sutiles y espectaculares a partes iguales. A partir del conocimiento ancestral poseido por entidades como nobles feéricos, demonios, diablos, sagas o los extraños seres del Reino Lejano, los brujos descubren secretos arcanos que refuerzan sus propios poderes.',8,'Carisma','Sabiduria y Carisma','Armas sencillas','Armadura ligera',null,null,2,2),
('Clerigo','Los clérigos son intermediarios entre el mundo mortal y los remotos planos de los dioses. Tan variopintos como las deidades a las que sirven, estos se esfuerzan por personificar las obras de sus dioses. Un clérigo no es un sacerdote corriente, pues está imbuido de magia divina',8,'Sabiduria','Sabiduria y Carisma','Armas sencillas','Armadura ligera, armadura intermedia, escudos',null,null,3,0),
('Druida','Un sacerdote de la Antigua Fe, que blande los poderes de la naturaleza la luz de la luna y el crecimiento de las plantas, el fuego y el rayo y que adopta formas animales.',8,'Sabiduria','Inteligencia y sabiduria','Bastones, cimitarras, clavas, dagas, dardos, hoces, hondas, jabalinas, mazas, lanzas','Armadura ligera, armadura intermedia, escudos (los druidas no llevan armadura ni usan escudos hechos de metal)',null,null,2,0),
('Explorador','Un guerrero que usa la proeza marcial y la magia de la naturaleza para combatir las amenazas en los límites de la civilización.',10,'Destreza y sabiduria','Fuerza y destreza','Armas sencillas, armas marciales','Armadura ligera, armadura intermedia, escudos',null,null,0,0),
('Hechicero','Un lanzador de conjuros que recurre a la magia inherente de un don o una línea de sangre.',6,'Carisma','Constitucion y Carisma','ballestas ligeras, bastones, dagas, dardos, hondas',null,null,null,4,2),
('Monje','Un maestro de las artes marciales, que domina el poder del cuerpo en busca de la perfección física y espiritual.',8,'Destreza y sabiduria','Fuerza y destreza','Armas sencillas, espadas cortas',null,null,null,0,0),
('Paladin','Un guerrero santo atado a un juramento sagrado.',10,'Fuerza y Carisma','Sabiduria y Carisma','Armas sencillas, armas marciales','Todas las armaduras, escudos',null,null,0,0),
('Picaro','Un rufián que usa sigilo y astucia para superar obstáculos y enemigos.',8,'Destreza','Destreza e Inteligencia','Armas sencillas, ballestas de mano, espadas largas, estoques, espadas cortas','Armadura ligera',null,null,0,0);

INSERT INTO Razas (NombreRaza,IncrementoEstadistica,Dimension,Velocidad,Vision,RazaPadre)
VALUES ('Elfo','Destreza 2','mediano',30,'vision en la oscuridad',null),
('Alto Elfo','Inteligencia 1',null,null,null,'Elfo'),
('Elfo de los Bosques','sabiduria 1',null,null,null,'Elfo'),
('Elfo Oscuro','Carisma 1',null,null,'vision en la oscuridad superior','Elfo'),
('Enano','Constitucion 2','mediano',25,'vision en la oscuridad',null),
('Enano de las Colinas','sabiduria 1',null,null,null,'Enano'),
('Enano de las Montañas','fuerza 2',null,null,null,'Enano'),

('Gnomo','Inteligencia 2','pequenyo',25,'vision en la oscuridad',null),
('Gnomo de los Bosques','Destreza 1',null,null,null,'Gnomo'),
('Gnomo de las Rocas','Constitucion 1',null,null,null,'Gnomo'),

('Humano','Carateristicas 1','mediano',30,null,null),
('Mediano','Destreza 2','pequenyo',25,null,null),
('Piesligeros','Carisma 1',null,null,null,'Mediano'),
('Fornido','Constitucion 1',null,null,null,'Mediano'),

('Semielfo','Carisma 2','mediano',30,'vision en la oscuridad',null),
('Semiorco','Fuerza 2, Constitucion 1','mediano',30,'vision en la oscuridad',null),
('Tiefling','Inteligencia 1, Carisma 2','mediano',30,'vision en la oscuridad',null);

INSERT INTO Idiomas (NombreIdioma)
VALUES ('Comun'),('Elfico'),('Enano'),('Gigante'),('Gnomo'),('Trasgo'),('Mediano'),('Orco'),
('Abismal'),('Celestial'),('Dragon'),('Habla Profunda'),('Infernal'),('Infracomun'),('Primordial'),('Silvano');

INSERT INTO Razas_Idiomas (NombreRaza, NombreIdioma)
VALUES ('Elfo','Comun'),('Elfo','Elfico'),
('Enano','Comun'),('Enano','Enano'),
('Gnomo','Comun'),('Gnomo','Gnomo'),
('Humano','Comun'),
('Mediano','Comun'),('Mediano','Mediano'),
('Semielfo','Comun'),('Semielfo','Elfico'),
('Semiorco','Comun'),('Semiorco','Orco'),
('Tiefling','Comun'),('Tiefling','Infernal');

INSERT INTO Armas (NombreArma,TipoArma,Coste,Dano,TipoDano,Peso)
VALUES ('Baston','Cuerpo a cuerpo sencilla','2pp','1d6','Contundente',4),
('Clava','Cuerpo a cuerpo sencilla','1pp','1d4','Contundente',2),
('Arco corto','Armas a distancia sencillas','25po','1d6','Perforante',2),
('Ballesta ligera','Armas a distancia sencillas','25po','1d8','Perforante',5),
('Alabarda','Armas cuerpo a cuerpo marciales','20po','1d10','Cortante',6),
('Cimitarra','Armas cuerpo a cuerpo marciales','25po','1d6','Cortante',3),
('Tridente','Armas cuerpo a cuerpo marciales','5po','1d6','Perforante',4),
('Arco largo','Armas a distancia marciales','50po','1d8','Perforante',2),
('Ballesta de mano','Armas a distancia marciales','75po','1d6','Perforante',3),
('Ballesta pesada','Armas a distancia marciales','50po','1d10','Perforante',18);

INSERT INTO PropiedadesArma (NombrePropiedadArma,Descripcion)
VALUES ('Versatil','Esta arma puede usarse con una o dos manos. Entre paréntesis aparece también un valor de daño: es el daño que inflige cuando se usa para hacer un ataque cuerpo a cuerpo con dos manos.'),
('Ligera','Un arma ligera es pequeña y fácil de manejar, ideal para luchar con dos armas.'),
('Municion','Solo puedes realizar un ataque a distancia con un arma con esta propiedad si tienes la munición requerida. Cada vez que ataques con ella, gastas parte de la munición. Coger la munición de una aljaba, de un estuche o de otro contenedor forma parte del ataque (necesitas una mano libre para cargar un arma de una mano). Al final del combate, puedes recuperar la mitad de la munición que hayas gastado dedicando 1 minuto a buscar por el campo de batalla.Si usas un arma que tiene la propiedad «munición» para realizar un ataque cuerpo a cuerpo, considera que el arma es improvisada (ver «Armas improvisadas» a continuación). Las ondas deben cargarse para infligir daño de este modo.'),
('Dos manos','Esta arma requiere que la sostengas con dos manos cuando atacas con ella.'),
('Alcance','Esta arma añade 5 pies a tu alcance cuando atacas con ella, así como cuando determinas tu alcance para hacer un ataque de oportunidad con ella.'),
('Pesada','El tamaño y el peso de un arma pesada hacen que sea demasiado grande para que las criaturas Pequeñas la utilicen con eficacia, por lo que tienen desventaja en las tiradas de ataque que realicen con estas armas.'),
('Sutil','Cuando hagas un ataque con un arma sutil, elige si utilizas tu modificador por Fuera o tu modificador por Destreza para la tirada de ataque y de daño. Debes usar el mismo modificador para ambas tiradas.'),
('Arrojadiza','Si un arma tiene esta propiedad, puedes lanzarla para hacer un ataque a distancia. Si el arma es de combate cuerpo a cuerpo, usa el mismo modificador por característica que utilizarías para hacer un ataque cuerpo a cuerpo con ella, tanto para la tirada de ataque como para la de daño. Por ejemplo, si arrojas un hacha, usas tu Fuerza, pero si arrojas una daga, puedes usar o tu Fuerza o tu Destreza, dado que la daga tiene la propiedad «sutil».'),
('De carga','Debido al tiempo que se necesita para cargar esta arma, solo puedes disparar una pieza de munición en la acción, acción adicional o reacción en que la dispares, independientemente del número de ataques que puedas hacer normalmente.'),
('Distancia','Un arma que puede usarse para hacer un ataque a distancia tiene un paréntesis en el que dice «a distancia» después de las propiedades «munición» o «arrojadiza». También aparecen dos números: el primero es la distancia normal del arma en pies, y el segundo, su distancia larga. Cuando ataques a un objetivo que está más lejos de la distancia habitual, tienes desventaja en la tirada de ataque. No puedes atacar a un objetivo que esté más lejos que la distancia larga.');

INSERT INTO Armas_PropiedadesArma VALUES ('Baston','Versatil'),('Clava','Ligera'),
('Arco corto','Municion'),('Ballesta ligera','Municion'),
('Alabarda','Pesada'),('Alabarda','Alcance'),('Alabarda','Dos manos'),
('Cimitarra','Sutil'),('Cimitarra','Ligera'),
('Tridente','Arrojadiza'),('Tridente','Versatil'),
('Arco largo','Municion'),
('Ballesta de mano','Municion'),('Ballesta de mano','ligera'),('Ballesta de mano','De carga'),
('Ballesta pesada','Municion'),('Ballesta pesada','Pesada'),('Ballesta pesada','De carga'),('Ballesta pesada','Dos manos');

INSERT INTO Armaduras (NombreArmadura,TipoArmadura,Coste,CA,MaximoDestreza,RequisitoFuerza,Sigilo,Peso)
VALUES ('Acolchada','Ligera','5po',11,null,null,'desventaja',8),
('Cuero','Ligera','10po',11,null,null,null,10),
('Cuero tachonao','Ligera','45po',12,null,null,null,13),
('Pieles','Intermedia','10po',12,2,null,null,12),
('Camisote de malla','Intermedia','50po',13,2,null,null,20),
('Cota de escamas','Intermedia','50po',14,2,null,'desventaja',45),
('Coraza','Intermedia','400po',14,2,null,null,20),
('Armadura de anillas','Pesada','30po',14,null,null,'desventaja',40),
('Cota de malla','Pesada','75po',16,null,15,'desventaja',55),
('Armadura laminada','Pesada','200po',17,null,15,'desventaja',60);

INSERT INTO Objetos (NombreObjeto,Descripcion,Coste,Peso)
VALUES ('Raciones(1 dia)',null,'5pp',2),('Saco de dormir',null,'1po',7);

INSERT INTO Conjuros(NombreConjuro,TiempoLanzamiento,Alcance,Componentes,Duracion,Descripcion,Salvacion)
VALUES ('Armadura de mago','1 accion','toque','V,S,M(un trozo de cuero curtido)','8 horas','Tocas a una criatura voluntaria, que no esté portando una armadura, y una fuerza mágica protectora la rodea hasta el fin de la duración del conjuro. La CA base del objetivo se vuelve 13 + su modificador de Destreza. El conjuro finaliza si el receptor se pone una armadura o si tú cancelas el conjuro como una acción.',null),
('Proyectil magico','1 accion','120 pies(24 casillas, 36 m)','V,S','instantanea','Creas tres dardos brillantes de fuerza mágica. Cada dardo impacta a una criatura de tu elección que puedas ver dentro del alcance. Un dardo inflige 1d4 + 1 puntos de daño por fuerza a su objetivo. Todos los dardos impactan a la vez, y los puedes dirigir para que impacten a una criatura o a varias. A niveles superiores. Cuando lanzas este hechizo usando un espacio de conjuros de nivel 2 o superior, el conjuro crea un dardo más por cada nivel de espacio de conjuros por encima de nivel 1.',null);

INSERT INTO Dotes (NombreDote,Requisito,Descripcion)
VALUES ('acechador','Destreza 13 o super(ior','Eres un experto en ocultarte en las sombras. Ganas los siguientes beneficios: • Puedes intentar esconderte cuando estás en penumbra de la criatura de la cual te estás ocultando. • Cuando estás escondido de una criatura y fallas con un arma a distancia, hacer el ataque no delatará tu posición. • La luz tenue no supone una desventaja para tus tiradas de Sabiduría (Percepción) si estas se basan en la vista.'),
('Actor',null,'Eres experimentado en la imitación y en el arte del drama. Ganas los siguientes beneficios: • Incrementa tu puntuación de Carisma en 1, hasta un máximo de 20. • Tienes ventaja en las tiradas de Carisma (Engañar) y Carisma (Interpretar) cuando intentas hacerte pasar por otra persona. • Puedes imitar el habla de otra persona o los sonidos hechos por otras criaturas. Debes haber oído a la persona hablar, o haber escuchado a la criatura haber hecho el sonido, por al menos un minuto. Una tirada exitosa de Sabiduría (Averiguar Intenciones) contra tu tirada de Carisma (Engañar) permite a alguien o algo que escucha determinar que el efecto es falso.');

INSERT INTO Personajes (Nombre,Clase,Trasfondo,Raza,Alineamiento,Experiencia,RasgosPersonalidad,Ideales,Vinculos,Defectos,Nivel,PGMaximos,CA,Fuerza,Destreza,Constitucion,inteligencia,Sabiduria,Carisma,RasgosAtributos)
VALUES ('Legolas','Guerrero',null,'Alto Elfo',null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null),
('Gandalf','Mago',null,'Piesligeros',null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null),
('Sauron','Hechicero',null,'Semielfo',null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null),
('Elrond','Picaro',null,'Semiorco',null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null),
('Boromir','Paladin',null,'Humano',null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);


INSERT INTO Trasfondo(Nombre,Descripcion)
VALUES ('acolito','Has pasado tu vida al servicio de un templo para un dios específico o panteón de dioses. Actúas como intermediario entre el reino del mundo sagrado y el mundo mortal, realizando ritos sagrados y ofreciendo sacrificios para llevar a los adoradores a la presencia de lo divino. No es necesariamente un clérigo; realizar ritos sagrados no es lo mismo que canalizar el poder divino.'),
('Criminal','Es un delincuente experimentado con un historial de infracción de la ley. Has pasado mucho tiempo entre otros criminales y todavía tienes contactos dentro del inframundo criminal. Estás mucho más cerca que la mayoría de la gente del mundo de asesinatos, robos y violencia que invade la parte más vulnerable de la civilización, y has sobrevivido hasta este punto burlando las reglas y regulaciones de la sociedad.'),
('Heroe popular','Vienes de un rango social humilde, pero estás destinado a mucho más. La gente de tu aldea de origen ya te considera su campeón, y tu destino te llama a enfrentarte a los tiranos y monstruos que amenazan a la gente común en todas partes.'),
('Embrujado','Estás atormentado por algo tan terrible que no te atreves a hablar de ello. Ha intentado enterrarlo y huir de él, sin éxito. Sea lo que sea esta cosa que te persigue, no puedes ser asesinado con una espada o desterrado con un hechizo. Puede que te llegue como una sombra en la pared, una pesadilla escalofriante, un recuerdo que se niega a morir o un susurro demoníaco en la oscuridad. La carga ha pasado factura, aislándote de la mayoría de las personas y haciéndote cuestionar tu cordura. Debes encontrar una manera de superarlo antes de que te destruya.'),
('Noble','Entiendes la riqueza, el poder y los privilegios. Posee un título noble y su familia posee tierras, recauda impuestos y ejerce una influencia política significativa. Puede que seas un aristócrata mimado que no esté familiarizado con el trabajo o la incomodidad, un antiguo comerciante que acaba de ascender a la nobleza o un sinvergüenza desheredado con un sentido desproporcionado de los derechos. O podría ser un terrateniente honesto y trabajador que se preocupa profundamente por las personas que viven y trabajan en su tierra, muy consciente de su responsabilidad hacia ellos.'),
('Sabio','Pasaste años aprendiendo la tradición del multiverso. Recorrió manuscritos, estudió pergaminos y escuchó a los mejores expertos en los temas que le interesan. Tus esfuerzos te han convertido en un maestro en tus campos de estudio.'),
('Soldado','La guerra ha sido su vida desde que quiere recordar. Te entrenaste cuando eras joven, estudiaste el uso de armas y armaduras, aprendiste técnicas básicas de supervivencia, incluido cómo mantenerte con vida en el campo de batalla. Es posible que haya sido parte de un ejército nacional permanente o una compañía de mercenarios, o quizás un miembro de una milicia local que saltó a la fama durante una guerra reciente.Cuando elija estos antecedentes, trabaje con su DM para determinar de qué organización militar formaba parte, cuánto progresó en sus filas y qué tipo de experiencias tuvo durante su carrera militar. ¿Era un ejército permanente, una guardia de la ciudad o una milicia de la aldea? O podría haber sido el ejército privado de un noble o un comerciante, o una compañía de mercenarios.');

INSERT INTO Clases_Armas_Armaduras_Objetos (NombreClase,NombreArma,NombreArmadura,NombreObjeto) VALUES 
("Barbaro","Baston","Coraza","Saco de dormir"),
("Bardo","Arco corto","Cuero","Saco de dormir"),
("Brujo","Ballesta ligera","Pieles","Raciones(1 dia)"),
("Clerigo","Clava","Cota de escamas","Raciones(1 dia)"),
("Druida","Baston","Coraza","Saco de dormir"),
("Explorador","Cimitarra","Pieles","Saco de dormir"),
("Guerrero","Arco largo","Cota de malla","Raciones(1 dia)"),
("Hechicero","Baston","Pieles","Saco de dormir"),
("Mago","Baston","Pieles","Raciones(1 dia)"),
("Monje","Clava","Cuero","Saco de dormir"),
("Paladin","Ballesta de mano","Cota de malla","Raciones(1 dia)"),
("Picaro","Arco corto","Pieles","Raciones(1 dia)");