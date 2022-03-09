--set schema 'negocio'
select 
	anio_academico, 
	turno_examen_nombre, 
	count(alumno) as inscriptos, 
	(
	select count(alumno)
	from vw_mesas_examen vme
		join sga_actas sa on vme.llamado_mesa = sa.llamado_mesa
		join sga_actas_detalle sda on sa.id_acta = sda.id_acta
	where resultado <> 'U'
		and vme.anio_academico = me.anio_academico 
		and vme.mesa_examen_ubicacion = 15 
		and vme.turno_examen_nombre = me.turno_examen_nombre
	) asistieron,
	(
	select count(alumno)
	from vw_mesas_examen vme
		join sga_actas sa on vme.llamado_mesa = sa.llamado_mesa
		join sga_actas_detalle sda on sa.id_acta = sda.id_acta
	where resultado = 'A'
		and vme.anio_academico = me.anio_academico 
		and vme.mesa_examen_ubicacion = 15 
		and vme.turno_examen_nombre = me.turno_examen_nombre
	) aprobaron,
	(
	select count(alumno)
	from vw_mesas_examen vme
		join sga_actas sa on vme.llamado_mesa = sa.llamado_mesa
		join sga_actas_detalle sda on sa.id_acta = sda.id_acta
	where resultado = 'R'
		and vme.anio_academico = me.anio_academico 
		and vme.mesa_examen_ubicacion = 15 
		and vme.turno_examen_nombre = me.turno_examen_nombre
	) reprobaron,
	(
	select count(alumno)
	from vw_mesas_examen vme
		join sga_actas sa on vme.llamado_mesa = sa.llamado_mesa
		join sga_actas_detalle sda on sa.id_acta = sda.id_acta
	where resultado = 'U'
		and vme.anio_academico = me.anio_academico 
		and vme.mesa_examen_ubicacion = 15 
		and vme.turno_examen_nombre = me.turno_examen_nombre
	) ausentes
from vw_mesas_examen me
	join sga_actas a on me.llamado_mesa = a.llamado_mesa
	join sga_actas_detalle da on a.id_acta = da.id_acta
where 
	me.anio_academico in (2018, 2019) 
	and me.mesa_examen_ubicacion = 15 
	and (me.turno_examen_nombre ilike '%mayo%' or me.turno_examen_nombre ilike '%septiembre%')

group by anio_academico, turno_examen_nombre
order by anio_academico, turno_examen_nombre