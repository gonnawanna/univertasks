def rec(s):
    if len(s) > 0:
        if s[0] == s[-1]:
            rec(s[1:-1])
            r = 'palindrom'
        else:
            r = 'ne palindrom'
        return r


i = int(input("i = "))
j = int(input("j = "))
s = str(input("s = "))
print(rec(s[i:j+1]))