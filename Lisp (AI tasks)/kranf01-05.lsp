(defun factorial (k)
  (cond
    ((equal k 1) 1)
    (t (* k (factorial (- k 1))))))

(defun sum (N k)
  (cond
    ((> k N) 0)
	(t (+ (exp (- 0 (factorial k))) (sum N (+ k 1))))))
