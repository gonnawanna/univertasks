def delsubstr(s, s0):
    n = len(s0)
    r = ''
    i = 0
    while i < len(s):
        s1 = s[i:][:n]
        if s1 == s0:
            i += n
        else:
            r += s[i]
            i += 1
    return r


print(delsubstr('три кота ж', ' '))
print(delsubstr('fooпfoofooриfooветfoo', 'foo'))
print(delsubstr('Новый Год', 'ёлка'))
