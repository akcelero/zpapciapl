#!/bin/python

import random

for i in range(1,20):
    print("insert into bossOf(idBoss, idWorker) values({}, {});".format(i, random.randint(1,20)));
