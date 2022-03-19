-- scripts tablas y datos iniciales jjg - agendamiento de citas
SET SQL_MODE='ALLOW_INVALID_DATES';
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


drop table if exists dct_salud_tbl_horario_esp_usu;
drop table if exists dct_salud_tbl_especialidad;
drop table if exists dct_salud_tbl_usuario_periodo_nodisp;
drop table if exists dct_salud_tbl_feriado;
drop table if exists dct_salud_tbl_agenda;
drop table if exists dct_salud_tbl_reserva_cita;

-- especialidad
create table dct_salud_tbl_especialidad(
esp_id_especialidad bigint not null AUTO_INCREMENT primary key,
esp_especialidad varchar(100),
esp_estado bit,
esp_minutos_atencion integer not null,
esp_fecha_creacion timestamp default now(),
esp_usuario_creacion varchar(13),
esp_fecha_modificacion TIMESTAMP,
esp_usuario_modificacion varchar(13),
esp_ip_creacion varchar(100),
esp_ip_modificacion varchar(100)
);

create index idx_especialidad_id_especialidad on dct_salud_tbl_especialidad(esp_id_especialidad);

-- horarios por usuario y especialidad
create table dct_salud_tbl_horario_esp_usu(
heu_id_horario_esp_usu bigint not null AUTO_INCREMENT,
heu_cod_usuario varchar(12),
heu_id_especialidad integer,
heu_hi time,
heu_hf time,
heu_lu bit,
heu_ma bit,
heu_mi bit,
heu_ju bit,
heu_vi bit,
heu_sa bit,
heu_dd bit,
heu_estado bit,
heu_vigencia_desde TIMESTAMP null,
heu_vigencia_hasta TIMESTAMP null,
heu_fecha_creacion timestamp default now(),
heu_usuario_creacion varchar(13),
heu_fecha_modificacion TIMESTAMP,
heu_usuario_modificacion varchar(13),
primary key(heu_id_horario_esp_usu)
);

create index idx_horarioespusu_cod_usuario on dct_salud_tbl_horario_esp_usu(heu_cod_usuario);
create index idx_horarioespusu_id_especialidad on dct_salud_tbl_horario_esp_usu(heu_id_especialidad);
create index idx_horarioespusu_fechacreacion on dct_salud_tbl_horario_esp_usu(heu_fecha_creacion);

-- tabla de vacaciones o ausencias por usuario

create table dct_salud_tbl_usuario_periodo_nodisp(
upn_cod_usuario varchar(12),
upn_fecha_inicio date NOT NULL,
upn_fecha_fin date NOT NULL,
upn_dia_completo bit NOT NULL,
upn_hora_inicio time,
upn_hora_fin time,
upn_indice_dias varchar(7),
upn_fecha_creacion timestamp default now()
);

create index idx_usuarioperiodonodisp_cod_usuario on dct_salud_tbl_usuario_periodo_nodisp(upn_cod_usuario);
create index idx_usuarioperiodonodisp_fechainicio on dct_salud_tbl_usuario_periodo_nodisp(upn_fecha_inicio);
create index idx_usuarioperiodonodisp_fechafin on dct_salud_tbl_usuario_periodo_nodisp(upn_fecha_fin);
create index idx_usuarioperiodonodisp_fechacreacion on dct_salud_tbl_usuario_periodo_nodisp(upn_fecha_creacion);


-- feriados

CREATE TABLE dct_salud_tbl_feriado
(
  frd_anio integer NOT NULL,
  frd_fecha_inicio date NOT NULL,
  frd_fecha_fin date NOT NULL,
  frd_descripcion varchar(350),
  frd_fecha_creacion timestamp default now(),
  PRIMARY KEY (frd_anio, frd_fecha_inicio, frd_fecha_fin)
);


insert into dct_salud_tbl_feriado(frd_anio,frd_fecha_inicio,frd_fecha_fin,frd_descripcion)
values (2022,'2022-12-24','2022-12-26','Navidad');


-- citas agendadas
create table dct_salud_tbl_agenda(
agd_id_agenda bigint not null AUTO_INCREMENT,
agd_cod_usuario varchar(12) not null,
agd_id_especialidad integer not null,
agd_estado varchar(2) not null,
agd_nombres_paciente varchar(600),
agd_identificacion varchar(13),
agd_fecha_nacimiento date,
agd_sexo varchar(1),
agd_telefono varchar(13),
agd_email varchar(300),
agd_fecha_cita date,
agd_hora_cita time,
agd_observacion varchar(3000),
agd_resultado varchar(3000),
agd_fecha_creacion timestamp default now(),
agd_fecha_modificacion timestamp,
agd_usuario_creacion varchar(16),
agd_usuario_modificacion varchar(16),
primary key (agd_id_agenda)
);

create index idx_agenda_uef on dct_salud_tbl_agenda(agd_cod_usuario,agd_id_especialidad,agd_fecha_creacion);
create index idx_agenda_idespecialidad on dct_salud_tbl_agenda(agd_id_especialidad);
create index idx_agenda_estado on dct_salud_tbl_agenda(agd_estado);
create index idx_agenda_cod_usuario on dct_salud_tbl_agenda(agd_cod_usuario);
create index idx_agenda_fechacita on dct_salud_tbl_agenda(agd_fecha_cita);
create index idx_agenda_fechacrea on dct_salud_tbl_agenda(agd_fecha_creacion);


create table dct_salud_tbl_reserva_cita(
rct_cedula_paciente VARCHAR(12) not null,
rct_cod_usuario varchar(12) not null,
rct_id_especialidad integer,
rct_minutos_atencion integer,
rct_fecha_cita TIMESTAMP not null,
rct_fecha_creacion timestamp default now(),
rct_usuario_creacion varchar(12)
);