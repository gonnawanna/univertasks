function([], _, R, R):- !.
function(_, [], R, R):- !.

function(L1, L2, R0, R):- [H1|T1] = L1
, [H2|T2] = L2
, R1 is R0 + (H1 * H2)
, function(T1, T2, R1, R).

skalyar(L1, L2):- function(L1, L2, 0, R), write(R), !.

example:- skalyar([3,0.5,7], [1,2,1,4]).