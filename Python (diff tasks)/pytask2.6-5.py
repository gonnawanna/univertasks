def fun6(A, B):
    R = set(element for element in B if element not in A)
    s = sum(R)
    return s

A = {2, 7, -6, 20, 13, -2}
B = {3, 6, 5, 7, -2}
print(fun6(A, B))