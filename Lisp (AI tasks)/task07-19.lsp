(defun foo (x)
  (cond 
    ((numberp x)
      (cond
        ((plusp x) (expt x 2))
        ((minusp x) (expt x 3))
        (t x)))
	(t x)))

(foo 3)
(foo (* -5 2))
(foo 0)
(foo '())