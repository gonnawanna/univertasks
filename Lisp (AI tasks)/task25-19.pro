sum(N, N, 0, R, R):- !.

sum(N, I0, N, R, R0):- I1 is I0 + 1
 , sum(N, I1, 0, R, R0).

sum(N, I0, J0, R, R0):- J1 is J0 + 1
 , I1 is I0 + 1
 , R1 is R0 + sqrt(I1) + J1 ** 2
 , sum(N, I0, J1, R, R1).

y(N) :- sum(N, 0, 0, R, 0), write(R), !.