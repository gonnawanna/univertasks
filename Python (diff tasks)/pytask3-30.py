import numpy as np

n = 3
m = 4
a = np.random.random_integers(-500, 500, [n, m])
print('The array:')
print(a)
positives = (a * (a > 0)).sum(0)
negatives = (a * (a < 0)).sum(0)
new = np.empty(m)
for i in range(m):
    if positives[i] > abs(negatives[i]):
        new[i] = - (positives[i] - abs(negatives[i]))
    else:
        new[i] = abs(negatives[i]) - positives[i]
new = np.asarray(new)
a = np.vstack((a, new))
print(a)
