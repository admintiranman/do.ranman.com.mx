create table desempenio (
    Calificacion smallint,
    Texto varchar(40)
)
go

create table potencial (
    Calificacion smallint,
    Texto varchar(40)
)
go


insert into desempenio
values
    (1, 'Bajo'),
    (2, 'Esperado'),
    (3, 'Sobrepasa')

go 



insert into potencial
values
    (1, 'Bajo'),
    (2, 'Medio'),
    (3, 'Alto')

go

