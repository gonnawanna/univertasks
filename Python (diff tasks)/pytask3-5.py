import numpy as np

n = int(input('n = '))
m = int(input('m = '))
a1 = np.random.random_integers(-500, 500, [n, m])
print('The array:')
print(a1)
avg_columns = np.mean(a1, axis=0)
a2 = np.vstack((a1, avg_columns))
avg_rows = np.mean(a2, axis=1)
a3 = np.column_stack((a2, avg_rows))
print('The result:')
print(a3)
