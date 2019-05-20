def fun5(T):
    L = [t for t in T if t % 2 == 0]
    count = len(L)
    return count

T = (2, 7, -6, 20, 13, -2)
print(fun5(T))