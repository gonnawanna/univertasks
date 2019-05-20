def ocreatearray():
    n = int(input('n = '))
    A = []
    for i in range(n):
        print('a[',i,'] = ', end = '')
        A.append(int(input()))
    return A

#A = [7, 3, 4, 3, 3, 9, 4, 15, 15, 15, 3]
#A = [ 9.9, 9.9, 9.9, 9.9]
#print(len(A))

def removerepeated(A):
    i = 0
    while i < len(A)-1:
        j = i + 1
        while j < len(A):
            if A[i] == A[j]:
                A.pop(j)
                j -= 1
            j += 1
        i += 1
    return A


print(removerepeated(ocreatearray()))