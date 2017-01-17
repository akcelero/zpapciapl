#!/bin/python
import random
for i in range(20):
    print("insert into visit(idClient, idPlace, data) values('{}', '{}', '{}-{:02d}-{:02d}');".format(random.randint(1,4), random.randint(1,3), random.randint(1,10)+1990, random.randint(1,12), random.randint(1,30)));
