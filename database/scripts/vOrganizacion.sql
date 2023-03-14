create view [dbo].[vOrganization]
as
(
	select 
		t.report_id as id,
		t.user_id,
		t.report_to as reporta,
		t.name as nombre,
		t.correo,
		t.job as puesto,
		t.nivel,
		t.puesto_critico as Puesto_Critico, 
		t.talento_clave as Talento_Clave,
		case
			when c.x_rendimiento = 0 and c.y_potencial = 0  then '#d0cece' -- 
			when c.x_rendimiento <= 66 and c.y_potencial between 0  and 75 then '#ff0000'
			when c.x_rendimiento between 67 and 95 and c.y_potencial between 0  and 75 then '#c55a11'
			when c.x_rendimiento >= 96 and c.y_potencial between 0  and 75 then '#ffd347'
		
			when c.x_rendimiento <= 66 and c.y_potencial between 76  and 95 then '#f19b61'
			when c.x_rendimiento between 67 and 95 and c.y_potencial between 76  and 95 then '#ffc000'
			when c.x_rendimiento >= 96 and c.y_potencial between 76  and 95 then '#0070c0'
		
			when c.x_rendimiento <= 66 and c.y_potencial >= 96 then '#ffd966'
			when c.x_rendimiento between 66 and 95 and c.y_potencial >= 96 then '#00b0f0'
			when c.x_rendimiento >= 96 and c.y_potencial >= 96 then '#00b050'
			else '#d0cece'
			end as color 
	from vTeam as t 
	left join dbo.evaluations as c on c.employee_name = t.name 
	and  c.created_at = ( select MAX(created_at) from dbo.evaluations as e where e.employee_name = c.employee_name)
)
GO


