import numpy as np

n = 3
m = 4
k = 1
a = np.arange(12).reshape((n, m))
print(a)
b = a[::, k, np.newaxis]
print(a*b)
