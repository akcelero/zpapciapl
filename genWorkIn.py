#!/bin/python
import random

positions = ["prezes", "viceprezes", "kasjer", "doradca", "prawnik", "sprzątacz"]

for i in range(1,20):
    print("insert into workIn(idWorker, idPlace, agreement, salary, position) values('{}', '{}', '{}-{:02d}-{:02d}', '{}', '{}');".format(
            i, random.randint(1,3), random.randint(0,5)+2017, random.randint(1,12), random.randint(1,30),
            random.randint(10,30) * 100, random.choice(positions)
         ));
