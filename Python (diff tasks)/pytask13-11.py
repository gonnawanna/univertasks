#A = [7, 2, 4, 2, 9.1]
def ocreatearray():
    n = int(input('n = '))
    A = []
    for i in range(n):
        print('a[',i,'] = ', end = '')
        A.append(int(input()))
    return A


def lastmin(A):
    min = A[0]
    r = 0
    for i in range(1,len(A)):
        if A[i] <= min:
           min = A[i]
           r = i
    return r

L = ocreatearray()
print(lastmin(L))