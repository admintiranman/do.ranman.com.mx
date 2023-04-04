create view vTeam
as
select 
	u.id as user_id, 
	u.report_id,
	u.name, 
	u.email as correo, 
	j.name as job,
	l.name as nivel,
	u.report_to,
	r.id as id_retro,
	r.avance as retro_avance,
	o.id as id_obj,
	o.start_filename, 
	o.start_path,
	o.start_lock,
	o.end_filename, 
	o.end_path, 
	o.end_lock,
	(case when o.start_filename is null then 0 else 50 end) + (case when o.end_filename is null then 0 else 50 end) as obj_avance, 
	e.uuid as id_ev, 
	case when e.status = 'close' then 100 else 0 end as ev_avance, 
	e.x_rendimiento, 
	e.y_potencial,
	ep.uuid as id_ep, 
	case when ep.status = 'close' then 100 else 0 end as ep_avance, 
	pdi.id as id_pdi, 
	pdi.avance as pdi_avance, 
	talento_clave, puesto_critico
from users as u
inner join jobs as j on j.id = u.job_id
inner join levels as l on l.id = u.level_id
left join objectives as o on o.id = 
(
	select max(id)
	from objectives as o2
	where o2.user_id = u.id
)
left join retroalimentaciones as r on r.id = 
(
	select max(id)
	from retroalimentaciones as r2
	where r2.user_id = u.id
)
left join evaluations as e on e.id = 
(
	select max(id)
	from evaluations as e2
	where e2.user_id = u.id
)
left join evaluacion_perfiles as ep on ep.id = 
(
	select max(id)
	from evaluacion_perfiles as ep2
	where ep2.user_id = u.id
)

left join planes_desarrollo_individual as pdi on pdi.id = 
(
	select max(id)
	from planes_desarrollo_individual as pdi2
	where pdi2.user_id = u.id
)
