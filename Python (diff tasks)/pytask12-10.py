def ocreatearray():
    n = int(input('n = '))
    A = []
    for i in range(n):
        print('a[',i,'] = ', end = '')
        A.append(int(input()))
    return A
        
def mcreatearray():
    n = int(input('n = '))
    m = int(input('m = '))
    A = []
    for i in range(m):
        row = []
        for j in range(n):
            print('a[',i,'][',j,'] = ', end = '')
            row.append(int(input()))
        A.append(row)
    return A
        
def oarray(A):
    s = 0
    for i in range(len(A)):
        if A[i]%9 == 0:
            s+= A[i]
    return s
    
def marray(A):
    s = 0
    for i in range(len(A)):
        for j in range(len(A[i])): 
            if A[i][j]%9 == 0:
                s+= A[i][j]
    return s
    
print(marray(mcreatearray()))