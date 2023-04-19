create view [dbo].[vResultadosEvaluacion]
as
	select 
		e.id, 
		e.Anio, 
		e.Nombre, 
		e.udn, 
		e.Nivel, 
		e.Puesto, 
		d.[Texto] as Desempenio, 
		p.[Texto] as Potencial, 
		e.X,
		e.Y, 
	CASE (E.X + E.Y) 
			WHEN 6 THEN 'PRIORITARIO' 
			WHEN 5 THEN 'DESARROLLABLE' 
			WHEN 4 THEN 'ESTABLE' 
			WHEN 3 THEN 'PRECAUCION' 
			WHEN 2 THEN 'BAJO' 
			ELSE 'NA' END 
		AS Box,
		e.x_rendimiento as xDesempenio, 
		e.y_potencial as yPotencial, 
		e.Area, 
		e.Puesto_Critico, 
		e.Talento_Clave,
		CASE WHEN E.Puesto_Critico = 1 THEN 'Puesto Critico' ELSE 'Ninguno' END AS Filtro_Puesto, 
		CASE WHEN E.Talento_Clave = 1 THEN 'Talento Clave' ELSE 'Ninguno' END AS Filtro_Talento, 
		e.created_at
	from dbo.vPreResultadosEvaluacion as e 
	inner join dbo.desempenio as d on d.Calificacion = e.X
	inner join dbo.potencial as p on p.calificacion = e.Y