import numpy as np

n = 3
m = 4
h = int(input('h = '))
a = np.random.random_integers(-5, 5, [n, m])
print('The array:')
print(a)
r = (a == h).sum(axis=0)
print(r)