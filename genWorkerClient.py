#!/bin/python

import random, string

names = ['ania', 'Wojtek', 'Andrzej', 'Michal', 'mateusz', 'Ewa', 'Jacek', 'Piotr', 'Kamil', 'Aleksander', 'Kasia', 'Monika', 'Marta']
surnames = ['Pachla', 'Wróbel', 'Dudek', 'Sikora', 'Zięba', 'Woźniak', 'Krawczyk', 'Szewczyk', 'Swat', 'Kaczmarek', 'Wdowiak', 'Cieślak']

for i in range(1,20):
    print("insert into workers(name, dateOfBirth, address) values ('{} {}', '{}-{:02d}-{:02d}', '{}');".format(
                    random.choice(names),
                    random.choice(surnames),
                    random.randint(1960,1999),random.randint(1,12), random.randint(1,30),
                    'address '+str(random.randint(1,50))+random.choice(string.ascii_letters)
                ));
