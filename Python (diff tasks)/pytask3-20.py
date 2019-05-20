import numpy as np

n = 3
a = np.random.random_integers(-5, 5, [n, n])
print(a)
b = np.flip(a, axis=0)
p1 = np.diag(b, 1).prod()
p2 = np.diag(b, -1).prod()
print(p1*p2)