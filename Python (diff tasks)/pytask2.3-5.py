def fun3(L):
    n = len(L)
    middle = L[n//2]
    i = 0
    while i < n:
        if L[i] == middle:
            del L[i]
        i += 1
        n = len(L)
    return L

L = [-5, 6, 9, 7, 8, 9, 60, -77, 7, 9]
print(fun3(L))