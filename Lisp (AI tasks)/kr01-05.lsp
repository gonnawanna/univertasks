(defun factorial (k)
  (cond
    ((equal k 1) 1)
    (t (* k (factorial (- k 1))))))
	
(defun subfun (k)
  (+(/(- (expt k 3) 1)(+ (expt k 3) 1))
	(/ 1 (factorial k))))
	  
(defun sum (N k)
  (cond
    ((> k N) 0)
	(t (+ (subfun k) (sum N (+ k 1))))))
	
(sum 2 1)