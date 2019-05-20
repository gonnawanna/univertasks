(defun y (N) 
  (labels 
    ( (subfun (i j) 
      (+ (sqrt i) (expt j 2)))

    (sumvnut (N i j) 
      (cond 
        ((> j N) (sumvnesh N i)) 
        (t (+ (subfun i j) (sumvnut N i (+ j 1))))))

    (sumvnesh (N i) 
      (cond 
        ((= i N) 0) 
        (t (+ (sumvnut N (+ i 1) 1) 0))))
	
	(main (N)
	  (cond 
        ((> N 0) (sumvnesh N 0)) 
        (t nil))) )
    (main N)))

(y 2)
;14,8
(y 3)
;54,4
;in order