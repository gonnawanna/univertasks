import numpy as np

a = np.random.random_integers(-2,3,[3,4])
print(a)
counter = (a == 0).sum(axis=0)
a = np.vstack((a, counter))
counter = (a == 0).sum(axis=1)
a = np.column_stack((a, counter))
print(a)