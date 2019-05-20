prsum(N, N, 0, R, 0, R):- !.

prsum(N, I0, N, R, R0, R1):- I1 is I0 + 1 ,
R2 is R1*R0,
prsum(N, I1, 0, R, 0, R2).

prsum(N, I0, J0, R, R0, R1):- J1 is J0 + 1, 
I1 is I0 + 1,
R2 is R0 + (I1/J1) + sqrt(J1),
prsum(N, I0, J1, R, R2, R1).

y(N) :- prsum(N, 0, 0, R, 0, 1), write(R).