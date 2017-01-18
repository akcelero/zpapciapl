#!/bin/python

import random

for i in range(1,20):
    a = i
    b = i
    while(a==b):
        b = random.randint(1,20)
    print("insert into bossOf(idWorker, idBoss) values({}, {});".format(a, b));
