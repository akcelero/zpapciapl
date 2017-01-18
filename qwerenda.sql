use zpapciapl;
select
					workers.dateOfBirth,
					workers.name,
					workers.address,
					bossOf.idBoss,
					workIn.idPlace,
					workIn.agreement,
					workIn.salary,
					workIn.position
				from workers
					inner join workIn on workIn.idWorker=workers.id
					inner join bossOf on workers.id=bossOf.idWorker
					inner join workers as boss on bossOf.idBoss=boss.id;

