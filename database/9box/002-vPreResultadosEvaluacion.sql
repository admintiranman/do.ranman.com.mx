CREATE view [dbo].[vPreResultadosEvaluacion]
as
select 
	ev.id, 
	c.[name] as Anio,
	upper(ev.[employee_name]) as Nombre,
	upper(ev.[udn]) as udn,	
	upper(ev.[level]) as Nivel, 
	upper(ev.[job]) as [Puesto],
	case 
		when x_rendimiento <= 66 then 1 
		when x_rendimiento > 67  and  x_rendimiento  <= 95 then 2 
		else 3 end as X, 

		case when y_potencial <= 76 then 1 
		when y_potencial > 76  and  y_potencial  <= 95 then 2 
		else 3 end as Y, 

	ev.x_rendimiento, 
	ev.y_potencial,
	UPPER(ev.departamento) as [Area],
	u.puesto_critico, 
	u.talento_clave , 
	ev.created_at
	
from dbo.evaluations as ev 
inner join dbo.ev_controls as c on c.id = ev.ev_control_id
inner join dbo.users as u on u.id = ev.[user_id]
where 
	ev.[x_rendimiento] <> 0  
	and ev.[y_potencial] <> 0
