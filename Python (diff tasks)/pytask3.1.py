import numpy as np

#a = np.arange(16).reshape((2,8))
#np.empty((2,8), dtype=int)
#np.random.random((2,8))
#a.astype(dtype=int, copy = False)
a = np.random.random_integers(-500, 500, [2,8])

print('1. New Numpy array:')
print(a)

print('2. Element [1,5]:', a[1,5])

print('3. Line number 1:')
print(a[0])

x = a[::-1,3]
print('4. 4th column reversed:')
print(x)

a.resize((4,4))
print('5. Reshaped to 4x4')
print(a)

a = a//2
print('6. Divisioned by 2:')
print(a)

r = a.min(axis=1)
print('7. Min of each line:', r)

m = np.max(a[-1])
print('8. Max in the last line:', m)

array1 = np.random.random_integers(-100, 100, [1, 10])
array2 = np.sign(array1)

d1 = (array2 == 1).sum()/array2.size*100
d2 = (array2 == -1).sum()/array2.size*100

print('9.', array1)
print('Positive:', d1, '%')
print('Negative:', d2, '%')

print('10.')
n = 5
m = 5
a = np.random.random_integers(-500, 500, [n, m])
print(a)
c = 0
for i in range(n):
    for j in range(m):
        if 9 < abs(a[i, j]) < 100:
            c += 1
print(c)